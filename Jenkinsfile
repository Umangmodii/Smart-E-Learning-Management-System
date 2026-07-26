pipeline {
    agent any

    stages {

        stage('Install Dependencies') {
            steps {
                dir('C:\\xampp\\htdocs\\SmartLMS') {
                    bat 'composer install --no-interaction --prefer-dist --optimize-autoloader'
                }
            }
        }

        stage('Laravel Cache') {
            steps {
                dir('C:\\xampp\\htdocs\\SmartLMS') {
                    bat 'php artisan optimize:clear'
                    bat 'php artisan config:cache'
                    bat 'php artisan route:cache'
                    bat 'php artisan view:cache'
                    bat 'php artisan optimize'
                }
            }
        }
    }

    post {
        success {
            echo 'Laravel deployment successful!'
        }

        failure {
            echo 'Laravel deployment failed!'
        }
    }
}