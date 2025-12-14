<?php
namespace App\Models;

class PortfolioModel {
    public function getPersonalInfo() {
        return [
            'name' => 'Ignacio Villanueva',
            'title' => 'Ingeniero Electrónico',
            'specialization' => 'Orientado al desarrollo IoT (Internet de las cosas)',
            'phone' => '+549 2612423836',
            'email' => 'nachovilla306@gmail.com',
            'location' => 'Mendoza, Argentina',
            'languages' => [
                ['name' => 'Español', 'level' => 'Nativo'],
                ['name' => 'Inglés', 'level' => 'B2']
            ]
        ];
    }
    
    public function getExperience() {
        return [
            [
                'company' => 'TTM DESARROLLOS SA',
                'period' => 'Marzo 2022 - Presente (3 años)',
                'position' => 'Ingeniero Electrónico en I+D',
                'description' => [
                    'Desarrollo de hardware y firmware para sensores de inclinación, vibración y presión en flotas de camiones u otros transportes.',
                    'Diseño y puesta en marcha de equipos para calibración de diversos tipos de sensores.',
                    'Desarrollo full stack para sistemas embebidos.'
                ]
            ]
        ];
    }
    
    public function getEducation() {
        return [
            [
                'institution' => 'Universidad Tecnológica Nacional',
                'degree' => 'Ingeniería Electrónica',
                'period' => 'Marzo 2017 - Noviembre 2024'
            ]
        ];
    }
    
    public function getSkills() {
        return [
            'Firmware' => ['C/C++', 'Arduino', 'Espressif', 'Microchip', 'STM32'],
            'Hardware' => ['Diseño de PCB (Eagle)', 'Sistemas embebidos', 'Microcontroladores'],
            'Backend' => ['Laravel', 'PHP 8+', 'MySQL'],
            'Frontend' => ['React JS', 'HTML', 'CSS'],
            'IoT' => ['MQTT (EMQX broker)', 'Sensores', 'Calibración'],
            'Otros' => ['FlutterFlow', 'PLC (Siemens)', 'HMI', 'AutoCAD']
        ];
    }
    
    public function getCompetencies() {
        return [
            'Trabajo en equipo',
            'Perseverancia',
            'Enfoque en la resolución de problemas',
            'Pensamiento estratégico',
            'Liderazgo',
            'Innovación científico-tecnológica'
        ];
    }
    
    public function getProjects() {
        return [
            [
                'id' => 1,
                'title' => 'Sistema de Monitoreo IoT para Flotas',
                'description' => 'Desarrollo completo de hardware y firmware para sensores de inclinación, vibración y presión en flotas de camiones. Sistema de comunicación MQTT con dashboard en tiempo real.',
                'fullDescription' => 'Este proyecto consistió en el desarrollo integral de un sistema IoT para monitoreo de flotas de transporte. Incluye el diseño y desarrollo de sensores de inclinación, vibración y presión que se instalan en los vehículos. Los sensores se comunican mediante protocolo MQTT con un broker centralizado, permitiendo el monitoreo en tiempo real de múltiples vehículos simultáneamente. El sistema cuenta con un dashboard web desarrollado en React que muestra gráficos interactivos, alertas automáticas y reportes históricos.',
                'technologies' => ['C/C++', 'ESP32', 'MQTT', 'Laravel', 'React', 'MySQL'],
                'category' => 'IoT',
                'image' => 'project-iot.jpg',
                'features' => [
                    'Sensores de inclinación y vibración',
                    'Comunicación MQTT en tiempo real',
                    'Dashboard web responsive',
                    'Alertas automáticas'
                ],
                'status' => 'Completado',
                'date' => '2023',
                'client' => 'TTM DESARROLLOS SA',
                'duration' => '6 meses'
            ],
            [
                'id' => 2,
                'title' => 'Equipo de Calibración de Sensores',
                'description' => 'Diseño y desarrollo de equipo automatizado para calibración de diversos tipos de sensores. Sistema con interfaz HMI y control mediante PLC.',
                'fullDescription' => 'Desarrollo de un sistema automatizado para la calibración de sensores de presión, inclinación y vibración. El equipo incluye una estación de trabajo con actuadores controlados por PLC Siemens, interfaz HMI para operación intuitiva, y software de gestión que genera reportes de calibración automáticos. El sistema permite calibrar múltiples tipos de sensores con alta precisión y repetibilidad.',
                'technologies' => ['PLC Siemens', 'HMI', 'C++', 'AutoCAD', 'Eagle'],
                'category' => 'Hardware',
                'image' => 'project-calibration.jpg',
                'features' => [
                    'Calibración automatizada',
                    'Interfaz HMI intuitiva',
                    'Control preciso mediante PLC',
                    'Reportes de calibración'
                ],
                'status' => 'Completado',
                'date' => '2022',
                'client' => 'TTM DESARROLLOS SA',
                'duration' => '4 meses'
            ],
            [
                'id' => 3,
                'title' => 'Sistema Embebido Full Stack',
                'description' => 'Desarrollo full stack para sistema embebido con backend Laravel, frontend React y comunicación MQTT. Gestión completa de dispositivos IoT.',
                'fullDescription' => 'Sistema completo de gestión para dispositivos IoT embebidos. Incluye backend desarrollado en Laravel con API RESTful, frontend moderno en React, y comunicación en tiempo real mediante MQTT. El sistema permite gestionar múltiples dispositivos, configurar parámetros remotamente, visualizar datos en tiempo real, y generar reportes históricos. Incluye sistema de autenticación y autorización robusto.',
                'technologies' => ['Laravel', 'PHP', 'React', 'MySQL', 'MQTT', 'ESP32'],
                'category' => 'Full Stack',
                'image' => 'project-fullstack.jpg',
                'features' => [
                    'API RESTful con Laravel',
                    'Frontend React moderno',
                    'Gestión de dispositivos',
                    'Autenticación segura'
                ],
                'status' => 'En Desarrollo',
                'date' => '2024',
                'client' => 'TTM DESARROLLOS SA',
                'duration' => 'En curso'
            ],
            [
                'id' => 4,
                'title' => 'Diseño de PCB para Sensor de Presión',
                'description' => 'Diseño completo de PCB en Eagle para sensor de presión con microcontrolador STM32. Optimizado para bajo consumo y alta precisión.',
                'fullDescription' => 'Diseño completo de una placa PCB para sensor de presión utilizando Eagle CAD. La placa integra un microcontrolador STM32, circuito de acondicionamiento de señal, y comunicación inalámbrica. El diseño fue optimizado para minimizar el consumo energético, permitiendo operación con batería durante largos períodos. Se desarrolló también el firmware en C/C++ para el procesamiento de señales y comunicación.',
                'technologies' => ['Eagle', 'STM32', 'C/C++', 'Sensores'],
                'category' => 'Hardware',
                'image' => 'project-pcb.jpg',
                'features' => [
                    'Diseño optimizado de PCB',
                    'Bajo consumo energético',
                    'Alta precisión de medición',
                    'Firmware embebido'
                ],
                'status' => 'Completado',
                'date' => '2023',
                'client' => 'TTM DESARROLLOS SA',
                'duration' => '3 meses'
            ],
            [
                'id' => 5,
                'title' => 'Dashboard de Monitoreo en Tiempo Real',
                'description' => 'Aplicación web React para visualización en tiempo real de datos de sensores IoT. Gráficos interactivos y alertas configurables.',
                'fullDescription' => 'Dashboard web desarrollado en React para visualización en tiempo real de datos provenientes de sensores IoT. La aplicación se conecta mediante MQTT para recibir datos en tiempo real, utiliza Chart.js para gráficos interactivos, y permite configurar alertas personalizadas. El diseño es completamente responsive y optimizado para diferentes dispositivos. Incluye funcionalidades de filtrado, exportación de datos, y visualización histórica.',
                'technologies' => ['React', 'JavaScript', 'MQTT', 'Chart.js', 'CSS'],
                'category' => 'Frontend',
                'image' => 'project-dashboard.jpg',
                'features' => [
                    'Visualización en tiempo real',
                    'Gráficos interactivos',
                    'Sistema de alertas',
                    'Diseño responsive'
                ],
                'status' => 'Completado',
                'date' => '2023',
                'client' => 'TTM DESARROLLOS SA',
                'duration' => '2 meses'
            ],
            [
                'id' => 6,
                'title' => 'Sistema de Comunicación MQTT con EMQX',
                'description' => 'Implementación de broker MQTT con EMQX para comunicación entre múltiples dispositivos IoT. Configuración de seguridad y QoS.',
                'fullDescription' => 'Implementación y configuración de un broker MQTT utilizando EMQX para gestionar la comunicación entre múltiples dispositivos IoT. El sistema incluye configuración de seguridad con TLS/SSL, gestión de niveles de QoS, autenticación de dispositivos, y monitoreo de conexiones. Se desarrollaron scripts en Python para automatización y gestión del broker. El sistema está desplegado en contenedores Docker para facilitar el despliegue y escalabilidad.',
                'technologies' => ['MQTT', 'EMQX', 'Linux', 'Docker', 'Python'],
                'category' => 'IoT',
                'image' => 'project-mqtt.jpg',
                'features' => [
                    'Broker MQTT escalable',
                    'Seguridad TLS/SSL',
                    'Gestión de QoS',
                    'Monitoreo de conexiones'
                ],
                'status' => 'Completado',
                'date' => '2023',
                'client' => 'TTM DESARROLLOS SA',
                'duration' => '1 mes'
            ]
        ];
    }
    
    public function getProjectCategories() {
        return [
            'Todos' => 'all',
            'IoT' => 'iot',
            'Hardware' => 'hardware',
            'Full Stack' => 'fullstack',
            'Frontend' => 'frontend'
        ];
    }
}
?>

