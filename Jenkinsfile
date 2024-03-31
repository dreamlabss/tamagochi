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
                    try {
                        def app = docker.build("dreamlabssdock/tamagochi")
                        env.DOCKER_APP = app
                    } catch (Exception e){
                        echo "Failed to build Docker img ${e.message}"
                        error "Docker image build failed"
                    }
                  
                }
            }
        }
        
        stage('Post-to-dockerhub') {
            steps {
                script {
                    docker.withRegistry('https://registry.hub.docker.com', 'dockerhub_creds') {
                        if(env.DOCKER_APP != null){
                            env.DOCKER_APP.push('latest')
                        } else {
                            error "Docker image is null"
                        }
                    }
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