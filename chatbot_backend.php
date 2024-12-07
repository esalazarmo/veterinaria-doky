<?php
session_start(); // Usamos sesiones para manejar el estado de la conversación

$apiKey = 'AIzaSyB-0H8eNJqOpM1YN4qZL4iPUz0PxaxgRoE';
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$apiKey}";

// Obtener el mensaje del usuario desde la solicitud AJAX
$inputText = $_POST['message'];

// Iniciar sesión y establecer la etapa inicial
if (!isset($_SESSION['etapa'])) {
    $_SESSION['etapa'] = 'inicio';
    $_SESSION['sintomas'] = []; // Array para guardar respuestas
}

// Lógica de flujo según la etapa
if ($_SESSION['etapa'] == 'inicio') {
    // Primera respuesta del bot
    $_SESSION['etapa'] = 'seleccion_opcion'; // Siguiente etapa
    echo json_encode(['reply' => "¿Qué acción deseas realizar? Escribe: 'prediagnóstico' o 'agendar cita'."]);
} elseif ($_SESSION['etapa'] == 'seleccion_opcion') {
    if (strtolower($inputText) == 'prediagnóstico') {
        $_SESSION['etapa'] = 'pregunta_sintomas'; // Pasar a la siguiente etapa
        echo json_encode(['reply' => "Por favor, describe el primer síntoma de tu mascota."]);
    } elseif (strtolower($inputText) == 'agendar cita') {
        echo json_encode(['reply' => "Puedes agendar una cita [aquí](https://ejemplo.com/cita)."]);
        session_destroy(); // Fin de sesión
    } else {
        echo json_encode(['reply' => "No entiendo esa opción. Escribe 'prediagnóstico' o 'agendar cita'."]);
    }
} elseif ($_SESSION['etapa'] == 'pregunta_sintomas') {
    // Acumular síntomas
    $_SESSION['sintomas'][] = $inputText;

    // Limitar el número de preguntas
    if (count($_SESSION['sintomas']) < 6) {
        echo json_encode(['reply' => "Describe otro síntoma de tu mascota o escribe 'fin' si no hay más."]);
    } else {
        // Enviar los síntomas acumulados a la API
        $sintomasTexto = implode(", ", $_SESSION['sintomas']);
        $data = [
            "contents" => [
                ["parts" => [
                    ["text" => "Prediagnóstico basado en los siguientes síntomas: " . $sintomasTexto]
                ]]
            ]
        ];

        // Configuración de cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Realizar la solicitud
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo json_encode(['error' => curl_error($ch)]);
        } else {
            $responseData = json_decode($response, true);
            $respuestaBot = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? "No se recibió respuesta.";
            echo json_encode([
                'reply' => $respuestaBot . "\n\nPara más información, visita: [este enlace](https://ejemplo.com/mas-informacion)"
            ]);
        }
        curl_close($ch);
        session_destroy(); // Fin del flujo
    }
}
?>
