<template>
        <div class="card">
            <div class="box">
            <div style="color: white; padding-bottom: 15px;">{{ name }}</div>
            <div class="percent">
                <svg>
                <circle cx="70" cy="70" r="70"></circle>
                <circle cx="70" cy="70" r="70" :style="{'strokeDashoffset': 'calc(440 - (440 * '+ percent +') / 100)'}"></circle>
                </svg>
                    <div class="num">
                    <h2>{{ percent / 10 }}<span></span></h2>
                    </div>
            </div>
            </div>
        </div>
</template>

<script>

export default {
    props: [
        'percent', 'name'
    ]
}

</script>