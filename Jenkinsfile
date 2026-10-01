pipeline {
    agent {
        docker {
            image 'macfit-ci:latest'
            args '-v $HOME/.composer:/tmp/composer'
        }
    }

    stages {

        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Install PHP Dependencies') {
            steps {
                sh 'composer install --no-interaction --prefer-dist'
            }
        }

        stage('Configure Laravel') {
            steps {
                sh '''
                    cp .env.example .env
                    touch database/database.sqlite
                    php artisan key:generate
                '''
            }
        }

        stage('Database Setup') {
            steps {
                sh 'php artisan migrate --force'
            }
        }

        stage('Run Tests') {
            steps {
                sh 'php artisan test'
            }
        }

        stage('Install Node Dependencies') {
            steps {
                sh 'npm install'
            }
        }

        stage('Build Frontend') {
            steps {
                sh 'npm run build'
            }
        }
    }

    post {
        success {
            echo 'MacFit CI pipeline completed successfully!'
        }

        failure {
            echo 'MacFit CI pipeline failed.'
        }
    }
}

