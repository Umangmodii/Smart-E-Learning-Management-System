pipeline {
    agent any

    stages {
        stage('Install Dependencies') {
            steps {
                bat 'composer install'
            }
        }

        stage('Laravel Cache') {
            steps {
                bat 'php artisan optimize:clear'
                bat 'php artisan config:cache'
                bat 'php artisan route:cache'
                bat 'php artisan view:cache'
                bat 'php artisan optimize'
            }
        }
    }
}