pipeline {
    agent{
        node {
            label 'ubuntu'
        }
    }
    
    
    stages {
        stage('Clonning Git') {
            steps {
                checkout scm
            }
        }
        
        stage('Build-and-tag') {
            steps {
                script {
                  def app = docker.build("dreamlabssdock/tamagochi")
                }
            }
        }
        
        stage('Post-to-dockerhub') {
            steps {
                script {
                    docker.withRegistry('https://registry.hub.docker.com', 'dockerhub_creds') {
                        app.push('latest')
                    }
                }
            }
        }
        
        stage('Pulling--image-server') {
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