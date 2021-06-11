<template>
    <div>
        <div class="container" v-if="authorizedState">
            <box :percent="health" :name="'Здоровье'" />
            <box :percent="hunger" :name="'Голод'" />
            <box :percent="fatigue" :name="'Усталость'" />

            <div class="card" style="display: flow-root">
                <h1 style="align-items: center; color: white;">Илья Денисов</h1>
                <div style="border: solid 1px; border-color: #00ff22; border-radius: 10%; max-width: 500px; max-height: 100px; padding: 3px;">
                    <h1 style="color: white">{{ name }}</h1>
                </div>
                <button @click="petAction(1)">Кормление</button>
                <button @click="petAction(2)">Игра</button>
                <button @click="petAction(3)">Сон</button>
            </div>
        </div>
        <div class="container" style="display: grid;" v-else>
            <h3 style="color: white;">К сожалению, вы еще не зарегистрированы, введите имя для Тамагочи</h3>
            <div style="margin: 0 auto; margin-top: 10px;">
                <input type="text" v-model="tamagochiName" />
                <button @click="startGame">Играть</button>
            </div>
        </div>
    </div>

</template>

<script>

require('./assets/css/style.css');

import Box from './components/Box';

import { mapState, mapMutations } from 'vuex';

export default {
    components: {
        Box
    },
    data() {
        return {
            authorizedState: false,
            tamagochiName: 'Гоша'
        }
    },
    mounted() {
        const cookieToken = this.$cookies.get('token');

        if (cookieToken) {
            this.axios.defaults.headers['authorization'] = 'Bearer ' + cookieToken;

            this.axios.get('/api/user/get').then(response => {
                if (response.data.authorized) {
                    this.authorizedState = response.data.authorized;
                    this.setHealth(response.data.tamagochi.health * 10);
                    this.setHunger(response.data.tamagochi.hunger * 10);
                    this.setFatigue(response.data.tamagochi.fatigue * 10);
                    this.setName(response.data.tamagochi.name);
                }
            });
        }
    },
    computed: {
        ...mapState('tamagochi', [
            'health',
            'hunger',
            'fatigue',
            'name'
        ])
    },
    methods: {
        ...mapMutations('tamagochi', [
            'setHealth',
            'setHunger',
            'setFatigue',
            'setName'
        ]),
        startGame() {
            this.axios.post('/api/user/register', {
                tamagochi: this.tamagochiName
            }).then(response => {
                if (response.data.authorized) {
                    this.axios.defaults.headers['authorization'] = 'Bearer ' + response.data.token;
                    this.authorizedState = response.data.authorized;
                    this.$cookies.set('token', response.data.token);
                    this.setHealth(response.data.tamagochi.health * 10);
                    this.setHunger(response.data.tamagochi.hunger * 10);
                    this.setFatigue(response.data.tamagochi.fatigue * 10);
                    this.setName(response.data.tamagochi.name);
                }
            });
        },
        petAction(type) {
            this.axios.post('/api/tamagochi/action', {
                action: type
            }).then(response => {
                    if (response.data.lose) {
                        alert("К сожалению, питомец погиб :(");
                    }
                    this.setHealth(response.data.tamagochi.health * 10);
                    this.setHunger(response.data.tamagochi.hunger * 10);
                    this.setFatigue(response.data.tamagochi.fatigue * 10);
            })
        }
    }
}
</script>