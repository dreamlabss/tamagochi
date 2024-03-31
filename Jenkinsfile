pipeline {
    agent{
        node {
            label 'ubuntu'
        }
    }

    environment {
        DOCKER_RESISRTY = 'true'
    }
    
    stages {
        stage('Clonning Git') {
            steps {
                checkout scm
            }
        }
        
        stage('Build-and-tag') {
            when {
                expression { DOCKER_RESISRTY = 'true' }
            }
            steps {
                script {
                    def app = docker.build("dreamlabssdock/tamagochi")
                    env.DOCKER_APP = app         
                }
            }
        }
        
        stage('Pulling-image-server') {
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
        
    }
}