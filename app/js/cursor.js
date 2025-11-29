// Script pour le curseur personnalisé
document.addEventListener('DOMContentLoaded', () => {
    const cursorDot = document.querySelector('.cursor-dot');
    const cursorDotOutline = document.querySelector('.cursor-dot-outline');
    
    // Variables pour la traînée du curseur
    const maxTrails = 10;
    const trails = [];
    let lastMouseX = 0;
    let lastMouseY = 0;
    let mouseSpeed = 0;
    
    // Créer les éléments de traînée
    for (let i = 0; i < maxTrails; i++) {
        const trail = document.createElement('div');
        trail.className = 'cursor-trail';
        document.body.appendChild(trail);
        trails.push({
            element: trail,
            x: 0,
            y: 0,
            alpha: 0,
            active: false
        });
    }
    
    // Fonction pour calculer la vitesse de la souris
    function calculateMouseSpeed(x, y) {
        const dx = x - lastMouseX;
        const dy = y - lastMouseY;
        mouseSpeed = Math.sqrt(dx * dx + dy * dy);
        
        lastMouseX = x;
        lastMouseY = y;
        
        return mouseSpeed;
    }
    
    // Fonction pour mettre à jour la position du curseur
    function updateCursorPosition(e) {
        const mouseX = e.clientX;
        const mouseY = e.clientY;
        
        // Mettre à jour le curseur principal
        cursorDot.style.top = `${mouseY}px`;
        cursorDot.style.left = `${mouseX}px`;
        
        cursorDotOutline.style.top = `${mouseY}px`;
        cursorDotOutline.style.left = `${mouseX}px`;
        
        // Calculer la vitesse de la souris
        const speed = calculateMouseSpeed(mouseX, mouseY);
        
        // Créer une traînée en fonction de la vitesse
        if (speed > 5) {
            createTrail(mouseX, mouseY);
        }
    }
    
    // Fonction pour créer une nouvelle traînée
    function createTrail(x, y) {
        // Trouver une traînée inactive
        const inactiveTrail = trails.find(trail => !trail.active);
        
        if (inactiveTrail) {
            // Configurer la traînée
            inactiveTrail.x = x;
            inactiveTrail.y = y;
            inactiveTrail.active = true;
            inactiveTrail.alpha = 0.8;
            
            // Mettre à jour le style
            inactiveTrail.element.style.left = `${x}px`;
            inactiveTrail.element.style.top = `${y}px`;
            inactiveTrail.element.style.opacity = inactiveTrail.alpha;
            inactiveTrail.element.style.width = `${Math.min(8, 4 + mouseSpeed / 10)}px`;
            inactiveTrail.element.style.height = `${Math.min(8, 4 + mouseSpeed / 10)}px`;
            
            // Animer la disparition
            setTimeout(() => {
                inactiveTrail.active = false;
                inactiveTrail.element.style.opacity = '0';
            }, 200 + Math.random() * 300);
        }
    }
    
    // Fonction pour l'effet de survol
    function handleMouseOver() {
        document.body.classList.add('hover-effect');
    }
    
    // Fonction pour l'effet de sortie
    function handleMouseOut() {
        document.body.classList.remove('hover-effect');
    }
    
    // Fonction pour l'effet de clic
    function handleMouseDown() {
        document.body.classList.add('click-effect');
    }
    
    // Fonction pour l'effet de relâchement
    function handleMouseUp() {
        document.body.classList.remove('click-effect');
    }
    
    // Surveiller les éléments survolables
    function trackHoverableElements() {
        const hoverableElements = document.querySelectorAll('.hover-target');
        
        hoverableElements.forEach(el => {
            el.addEventListener('mouseover', handleMouseOver);
            el.addEventListener('mouseout', handleMouseOut);
        });
    }
    
    // Événements de la souris
    window.addEventListener('mousemove', updateCursorPosition);
    document.addEventListener('mousedown', handleMouseDown);
    document.addEventListener('mouseup', handleMouseUp);
    
    // Initialiser le suivi des éléments survolables
    trackHoverableElements();
    
    // Mettre à jour les éléments survolables lors des ajouts dynamiques au DOM
    const observer = new MutationObserver(trackHoverableElements);
    observer.observe(document.body, { childList: true, subtree: true });
    
    // Masquer le curseur natif sur les éléments interactifs
    const interactiveElements = document.querySelectorAll('a, button, input, textarea, select, .hover-target');
    interactiveElements.forEach(el => {
        el.style.cursor = 'none';
    });
    
    // Ajouter un effet de lumière autour du curseur en mouvement
    let lastTime = 0;
    const throttleInterval = 50; // ms
    
    function glowEffect(timestamp) {
        if (timestamp - lastTime > throttleInterval) {
            lastTime = timestamp;
            
            // Créer un effet de lumière subtil qui suit le curseur
            const glow = document.createElement('div');
            glow.style.position = 'fixed';
            glow.style.width = '30px';
            glow.style.height = '30px';
            glow.style.borderRadius = '50%';
            glow.style.background = 'radial-gradient(circle, hsl(54, 100.00%, 56.90%), 0%, rgba(255, 8, 240, 0.4) 70%)';
            glow.style.pointerEvents = 'none';
            glow.style.zIndex = '9997';
            glow.style.top = `${lastMouseY}px`;
            glow.style.left = `${lastMouseX}px`;
            glow.style.transform = 'translate(-50%, -50%)';
            glow.style.opacity = '0.8';
            glow.style.filter = 'blur(5px)';
            
            document.body.appendChild(glow);
            
            // Animation de fondu
            setTimeout(() => {
                glow.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                glow.style.opacity = '0';
                glow.style.transform = 'translate(-50%, -50%) scale(1.5)';
                
                // Supprimer l'élément après l'animation
                setTimeout(() => {
                    document.body.removeChild(glow);
                }, 500);
            }, 10);
        }
        
        requestAnimationFrame(glowEffect);
    }
    
    // Démarrer l'effet de lumière
    requestAnimationFrame(glowEffect);
});