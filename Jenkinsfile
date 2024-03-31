pipeline {
    agent {
        label 'ubuntu'
    }
    
    def app

    stages {

        stage('Clonning Git') {
            steps
            {
            // Check scm
            checkout scm
            }       
        }

        stage('Build-and-tag'){
            steps {
                app = docker.build(dreamlabssdock/tamagochi)
            }
        }

        stage('Post-to-dockerhub'){
            steps {
                docker.withRegistry('https://registry.hub.docker.com', 'dockerhub_creds') {
                    app.push('latest')
                }
            }
        }

        stage('Pulling--image-server'){
            steps {
                sh "docker-compose down"
                sh "docker-compose up -d"
            }
        }

        stage('SAST') {
            steps {
                sh 'echo SAST stage'
            }
        }


        stage('Post-to-docker-hub'){
            steps{
                sh 'echo pullign image ...'
            }
        }

        stage('DAST') {
            steps {
                sh 'echo dast scan for security'
            }
            
        }
    }
}