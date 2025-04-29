<?php
class MedicalAI {
    private $knowledgeBase = [
        'headache' => [
            'possible_conditions' => ['Tension headache', 'Migraine', 'Sinusitis', 'Dehydration'],
            'severity' => 'medium',
            'advice' => "Rest in a quiet, dark room. Apply a cool compress to your forehead. Stay hydrated. Over-the-counter pain relievers may help."
        ],
        'fever' => [
            'possible_conditions' => ['Viral infection', 'Bacterial infection', 'Flu', 'COVID-19'],
            'severity' => 'high',
            'advice' => "Stay hydrated and rest. Use fever-reducing medications if needed. Seek medical attention if fever is above 103°F (39.4°C) or lasts more than 3 days."
        ],
        'stomach pain' => [
            'possible_conditions' => ['Indigestion', 'Food poisoning', 'Gastritis', 'Appendicitis'],
            'severity' => 'medium',
            'advice' => "Avoid solid foods for a few hours. Sip clear fluids. Avoid dairy, caffeine, and alcohol. Seek medical help if pain is severe or persistent."
        ],
        'cough' => [
            'possible_conditions' => ['Common cold', 'Flu', 'Allergies', 'Bronchitis'],
            'severity' => 'low',
            'advice' => "Stay hydrated. Use cough drops or honey. Consider a humidifier. See a doctor if cough persists more than 3 weeks or is accompanied by fever."
        ]
    ];

    private $references = [
        [
            'title' => 'CDC Health Topics A-Z',
            'url' => 'https://www.cdc.gov/az/index.html'
        ],
        [
            'title' => 'Mayo Clinic Symptoms Checker',
            'url' => 'https://www.mayoclinic.org/symptom-checker/select-symptom/itt-20009075'
        ],
        [
            'title' => 'WHO Health Advice',
            'url' => 'https://www.who.int/health-topics'
        ]
    ];

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['symptoms'])) {
            $symptoms = strtolower(trim($_POST['symptoms']));
            return $this->analyzeSymptoms($symptoms);
        }
        return ['text' => ''];
    }

    private function analyzeSymptoms($symptoms) {
        $response = ['text' => ''];
        $matchedConditions = [];
        $highestSeverity = 'low';

        // Simple keyword matching (in a real app, use NLP)
        foreach ($this->knowledgeBase as $keyword => $data) {
            if (strpos($symptoms, $keyword) !== false) {
                $matchedConditions = array_merge($matchedConditions, $data['possible_conditions']);
                if ($this->getSeverityLevel($data['severity']) > $this->getSeverityLevel($highestSeverity)) {
                    $highestSeverity = $data['severity'];
                }
                $response['text'] .= $data['advice'] . "\n\n";
            }
        }

        if (!empty($matchedConditions)) {
            $response['text'] = "Based on your symptoms, here's what might help:\n\n" . $response['text'];
            $response['symptom_analysis'] = [
                'possible_conditions' => array_unique($matchedConditions),
                'severity' => $highestSeverity
            ];
            $response['references'] = $this->references;
        } else {
            $response['text'] = "I couldn't identify specific conditions based on your symptoms. It's always best to consult with a healthcare professional for proper evaluation.";
            $response['references'] = $this->references;
        }

        return $response;
    }

    private function getSeverityLevel($severity) {
        $levels = ['low' => 1, 'medium' => 2, 'high' => 3];
        return $levels[$severity] ?? 1;
    }
}
?>