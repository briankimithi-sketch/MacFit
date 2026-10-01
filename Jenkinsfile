pipeline {
    agent {
	node{
		customWorkspace`/home/brian.kimithi/jenkins-workspace/MacFit-Pipeline`	
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
                sh 'docker run --rm -v "$PWD":/app -w /app macfit-ci:latest composer install --no-interaction --prefer-dist'
            }
        }

        stage('Configure Laravel') {
            steps {
                sh '''
                    docker run --rm \
                        -v "$PWD":/app \
                        -w /app \
                        macfit-ci:latest \
                        bash -lc '
                            cp .env.example .env
                            touch database/database.sqlite
                            php artisan key:generate
                        '
                '''
            }
        }

        stage('Database Setup') {
            steps {
                sh 'docker run --rm -v "$PWD":/app -w /app macfit-ci:latest php artisan migrate --force'
            }
        }

        stage('Run Tests') {
            steps {
                sh 'docker run --rm -v "$PWD":/app -w /app macfit-ci:latest php artisan test'
            }
        }

        stage('Install Node Dependencies') {
            steps {
                sh 'docker run --rm -v "$PWD":/app -w /app macfit-ci:latest npm install'
            }
        }

        stage('Build Frontend') {
            steps {
                sh 'docker run --rm -v "$PWD":/app -w /app macfit-ci:latest npm run build'
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

