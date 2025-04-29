<?php
require_once 'medical_ai_backend.php';
$medicalAI = new MedicalAI();
$response = $medicalAI->handleRequest();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Advanced Medical AI Assistant</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #2c7be5;
      --secondary-color: #6c757d;
      --success-color: #00d97e;
      --warning-color: #f6c343;
      --danger-color: #e63757;
      --light-color: #f9fafd;
      --dark-color: #12263f;
      --text-color: #495057;
      --border-radius: 12px;
      --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      --transition: all 0.3s ease;
    }
    
    body {
      font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
      margin: 0;
      height: 100vh;
      background-color: #f5f7fa;
      color: var(--text-color);
      line-height: 1.6;
    }
    
    .chat-container {
      max-width: 800px;
      height: 100vh;
      display: flex;
      flex-direction: column;
      background-color: #fff;
      box-shadow: var(--box-shadow);
      margin: 0 auto;
      position: relative;
      overflow: hidden;
    }
    
    .chat-header {
      background: linear-gradient(135deg, var(--primary-color), #1a5cb8);
      color: white;
      padding: 1.2rem 1.5rem;
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .chat-header h2 {
      font-weight: 600;
      font-size: 1.5rem;
      margin: 0;
    }
    
    .chat-header p {
      opacity: 0.9;
      margin: 0.3rem 0 0;
      font-size: 0.9rem;
    }
    
    .chat-body {
      flex: 1;
      overflow-y: auto;
      padding: 1.5rem;
      background-color: #f9fafd;
      background-image: radial-gradient(circle at 1px 1px, #e5e7eb 1px, transparent 0);
      background-size: 20px 20px;
    }
    
    .chat-footer {
      border-top: 1px solid #e5e8ec;
      padding: 1.2rem 1.5rem;
      background-color: #fff;
      position: sticky;
      bottom: 0;
    }
    
    .message {
      margin-bottom: 1.2rem;
      padding: 0.9rem 1.2rem;
      border-radius: var(--border-radius);
      max-width: 85%;
      position: relative;
      font-size: 0.95rem;
      line-height: 1.5;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
      animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .user-message {
      background-color: var(--primary-color);
      color: white;
      margin-left: auto;
      border-bottom-right-radius: 4px;
    }
    
    .bot-message {
      background-color: white;
      border: 1px solid #e5e8ec;
      margin-right: auto;
      border-bottom-left-radius: 4px;
      box-shadow: var(--box-shadow);
    }
    
    .medical-card {
      background-color: white;
      border: 1px solid #e5e8ec;
      padding: 1.2rem;
      border-radius: var(--border-radius);
      margin-top: 1.2rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    
    .medical-card h6 {
      color: var(--primary-color);
      font-weight: 600;
      margin-bottom: 0.8rem;
      display: flex;
      align-items: center;
    }
    
    .reference-card a {
      text-decoration: none;
      color: var(--primary-color);
      transition: var(--transition);
      display: block;
      padding: 0.6rem 0.8rem;
      border-radius: 6px;
    }
    
    .reference-card a:hover {
      background-color: rgba(44, 123, 229, 0.1);
      text-decoration: none;
    }
    
    .quick-replies {
      margin-top: 1rem;
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
    }
    
    .quick-reply-btn {
      background-color: #edf2f9;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 20px;
      cursor: pointer;
      transition: var(--transition);
      font-size: 0.85rem;
      color: var(--primary-color);
      font-weight: 500;
    }
    
    .quick-reply-btn:hover {
      background-color: #e1e7f4;
      transform: translateY(-1px);
    }
    
    .input-group {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    .form-control {
      flex-grow: 1;
      padding: 0.75rem 1rem;
      border-radius: var(--border-radius);
      border: 1px solid #e5e8ec;
      resize: none;
      transition: var(--transition);
      font-size: 0.95rem;
    }
    
    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(44, 123, 229, 0.2);
    }
    
    .voice-btn, #submitBtn {
      padding: 0.75rem;
      border-radius: 50%;
      width: 44px;
      height: 44px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: var(--transition);
    }
    
    .voice-btn {
      background-color: #edf2f9;
      color: var(--primary-color);
      border: none;
    }
    
    .voice-btn:hover {
      background-color: #e1e7f4;
    }
    
    #submitBtn {
      background-color: var(--primary-color);
      color: white;
      border: none;
    }
    
    #submitBtn:hover {
      background-color: #1a5cb8;
      transform: translateY(-1px);
    }
    
    .severity-indicator {
      display: inline-block;
      width: 12px;
      height: 12px;
      border-radius: 50%;
      margin-right: 0.5rem;
    }
    
    .severity-low {
      background-color: var(--success-color);
    }
    
    .severity-moderate {
      background-color: var(--warning-color);
    }
    
    .severity-high {
      background-color: var(--danger-color);
    }
    
    .warning-message {
      color: var(--danger-color);
      font-size: 0.85rem;
      margin-top: 0.8rem;
      padding: 0.6rem;
      background-color: rgba(230, 55, 87, 0.08);
      border-radius: 6px;
      display: flex;
      align-items: center;
    }
    
    .language-selector {
      position: absolute;
      top: 1.2rem;
      right: 1.5rem;
    }
    
    .dropdown-toggle {
      background-color: rgba(255, 255, 255, 0.15);
      border: none;
      padding: 0.35rem 0.8rem;
      font-size: 0.85rem;
    }
    
    .dropdown-toggle:hover {
      background-color: rgba(255, 255, 255, 0.25);
    }
    
    .symptom-item {
      padding: 0.4rem 0;
      border-bottom: 1px solid #f0f2f5;
      display: flex;
      align-items: center;
    }
    
    .symptom-item:last-child {
      border-bottom: none;
    }
    
    .welcome-message {
      background-color: white;
      border: 1px solid #e5e8ec;
      padding: 1.2rem;
      border-radius: var(--border-radius);
      margin-bottom: 1.5rem;
      box-shadow: var(--box-shadow);
    }
    
    .welcome-message p:first-child {
      font-weight: 500;
      margin-bottom: 0.8rem;
    }
    
    /* Scrollbar styling */
    ::-webkit-scrollbar {
      width: 8px;
    }
    
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
      background: #c1c1c1;
      border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: #a8a8a8;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .chat-container {
        max-width: 100%;
        border-radius: 0;
      }
      
      .message {
        max-width: 90%;
      }
      
      .chat-header {
        padding: 1rem;
      }
      
      .chat-header h2 {
        font-size: 1.3rem;
      }
    }
  </style>
</head>
<body>
  <div class="container-fluid p-0 h-100">
    <div class="chat-container mx-auto h-100">
      <div class="chat-header position-relative">
        <h2><i class="fas fa-robot me-2"></i> Medical AI Assistant</h2>
        <p class="mb-0">Describe your symptoms or ask medical questions</p>
        
        <div class="language-selector dropdown">
          <button class="btn btn-sm dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown">
            <i class="fas fa-language me-1"></i> English
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#" data-lang="en">English</a></li>
            <li><a class="dropdown-item" href="#" data-lang="es">Español</a></li>
            <li><a class="dropdown-item" href="#" data-lang="fr">Français</a></li>
            <li><a class="dropdown-item" href="#" data-lang="de">Deutsch</a></li>
            <li><a class="dropdown-item" href="#" data-lang="zh">中文</a></li>
          </ul>
        </div>
      </div>
      
      <div class="chat-body" id="chatBody">
        <div class="welcome-message">
          <p>Hello! I'm your Medical AI Assistant. How can I help you today?</p>
          <p>You can describe your symptoms, ask medical questions, or try one of these examples:</p>
          <div class="quick-replies mt-3">
            <button class="quick-reply-btn" onclick="insertQuickReply(this)"><i class="fas fa-head-side-cough me-1"></i> Headache and fever</button>
            <button class="quick-reply-btn" onclick="insertQuickReply(this)"><i class="fas fa-stomach me-1"></i> Stomach pain</button>
            <button class="quick-reply-btn" onclick="insertQuickReply(this)"><i class="fas fa-allergies me-1"></i> Allergy symptoms</button>
            <button class="quick-reply-btn" onclick="insertQuickReply(this)"><i class="fas fa-lungs me-1"></i> Shortness of breath</button>
          </div>
        </div>
        
        <?php if (!empty($_POST['symptoms'])): ?>
          <div class="message user-message">
            <p><?php echo htmlspecialchars($_POST['symptoms']); ?></p>
          </div>
          
          <div class="message bot-message">
            <?php echo nl2br(htmlspecialchars($response['text'])); ?>
            
            <?php if (!empty($response['symptom_analysis'])): ?>
              <div class="medical-card mt-3">
                <h6><i class="fas fa-heartbeat me-2"></i> Symptom Analysis</h6>
                <p>Possible conditions based on your symptoms:</p>
                <ul class="list-unstyled">
                  <?php foreach ($response['symptom_analysis']['possible_conditions'] as $condition): ?>
                    <li class="symptom-item">
                      <i class="fas fa-arrow-right me-2 text-muted"></i>
                      <?php echo htmlspecialchars($condition); ?>
                    </li>
                  <?php endforeach; ?>
                </ul>
                <p class="mt-2 mb-1">
                  <span class="severity-indicator severity-<?php echo $response['symptom_analysis']['severity']; ?>"></span>
                  <strong>Severity:</strong> <?php echo ucfirst($response['symptom_analysis']['severity']); ?>
                </p>
                <?php if ($response['symptom_analysis']['severity'] === 'high'): ?>
                  <p class="warning-message mt-2">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Important:</strong> These symptoms may indicate a serious condition. Please seek immediate medical attention.
                  </p>
                <?php else: ?>
                  <p class="warning-message mt-2">
                    <i class="fas fa-info-circle me-2"></i>
                    This is not a diagnosis. Please consult a healthcare professional for proper evaluation.
                  </p>
                <?php endif; ?>
              </div>
            <?php endif; ?>
            
            <?php if (!empty($response['references'])): ?>
              <div class="medical-card reference-card mt-3">
                <h6><i class="fas fa-book-medical me-2"></i> Medical References</h6>
                <div class="list-group">
                  <?php foreach ($response['references'] as $ref): ?>
                    <a href="<?php echo htmlspecialchars($ref['url']); ?>" class="list-group-item list-group-item-action" target="_blank">
                      <i class="fas fa-external-link-alt me-2"></i>
                      <?php echo htmlspecialchars($ref['title']); ?>
                      <span class="badge bg-light text-dark ms-2 float-end"><?php echo htmlspecialchars($ref['source']); ?></span>
                    </a>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>
            
            <div class="quick-replies mt-3">
              <button class="quick-reply-btn" onclick="insertQuickReply(this)"><i class="fas fa-question-circle me-1"></i> What should I do?</button>
              <button class="quick-reply-btn" onclick="insertQuickReply(this)"><i class="fas fa-user-md me-1"></i> When to see a doctor?</button>
              <button class="quick-reply-btn" onclick="insertQuickReply(this)"><i class="fas fa-home me-1"></i> Home remedies</button>
              <button class="quick-reply-btn" onclick="insertQuickReply(this)"><i class="fas fa-pills me-1"></i> Medication options</button>
            </div>
          </div>
        <?php endif; ?>
      </div>
      
      <div class="chat-footer">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="chatForm">
          <div class="input-group">
            <textarea class="form-control" name="symptoms" id="userInput" rows="2" 
                      placeholder="Describe your symptoms or ask a medical question..." required></textarea>
            <button type="button" class="btn voice-btn" id="voiceBtn" title="Voice Input">
              <i class="fas fa-microphone"></i>
            </button>
            <button class="btn" type="submit" id="submitBtn">
              <i class="fas fa-paper-plane"></i>
            </button>
          </div>
          <div class="form-text mt-2 text-center">
            <small class="text-muted"><i class="fas fa-info-circle me-1"></i> This AI provides general health information only. It's not a substitute for professional medical advice.</small>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function insertQuickReply(button) {
      const text = button.textContent.replace(/^\s+|\s+$/g, '');
      document.getElementById('userInput').value = text;
      document.getElementById('userInput').focus();
    }
    
    // Auto-scroll to bottom of chat
    const chatBody = document.getElementById('chatBody');
    chatBody.scrollTop = chatBody.scrollHeight;
    
    // Language selector functionality
    document.querySelectorAll('.dropdown-item[data-lang]').forEach(item => {
      item.addEventListener('click', function(e) {
        e.preventDefault();
        const lang = this.getAttribute('data-lang');
        // Here you would typically implement language change logic
        alert('Language changed to: ' + this.textContent);
        document.querySelector('#languageDropdown i.fa-language').nextSibling.textContent = ' ' + this.textContent;
      });
    });
    
    // Voice recognition would be implemented here
    document.getElementById('voiceBtn').addEventListener('click', function() {
      alert('Voice input would be activated here in a real implementation');
    });
  </script>
</body>
</html>