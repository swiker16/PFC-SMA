pipeline {
    agent any
    
    environment {
        SONARQUBE_SCANNER_HOME = tool name: 'SonarQubeScanner', type: 'hudson.plugins.sonar.SonarRunnerInstallation'
    }

    stages {
        stage('Checkout') {
            steps {
                script {
                    // Limpia cualquier directorio de trabajo anterior y clona el repositorio
                    cleanWs()
                    checkout scm
                }
            }
        }

        stage('Build') {
            steps {
                // Configura el entorno de PHP (puedes personalizar esto según tus necesidades)
                sh 'phpenv local 7.4'
                sh 'composer install' // Si usas Composer para gestionar las dependencias

                // Realiza la construcción de tu proyecto PHP
                sh 'php -l index.php' // Ejemplo de comando de construcción
            }
        }

        stage('SonarQube Analysis') {
            steps {
                withSonarQubeEnv('Your_SonarQube_Server') {
                    // Ejecuta el análisis de SonarQube
                    sh "${tool 'SonarQubeScanner'}/bin/sonar-scanner"
                }
            }
        }
    }
}
