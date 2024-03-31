pipeline {

    agent any

    stages {

        stage('Clonning Git') {
            steps
            {
                // Check scm
                checkout scm
            }       
        }
        
        stage('SAST') {
            steps {
                sh 'echo SAST stage'
            }
        }

        stage('Build-and-tag'){
            steps {
                sh 'echo buid and tag'
            }
        }

        stage('Post-to-docker-hub'){
            sh 'echo pullign image ...'
        }

        stage('DAST') {
            steps {
                sh 'echo dast scan for security'
            }
        }
    }
}