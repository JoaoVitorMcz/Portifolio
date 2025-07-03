document.addEventListener('DOMContentLoaded', function() {

    // Inicializa a biblioteca Animate On Scroll (AOS)
    AOS.init({
        duration: 800, // Duração da animação em milissegundos
        once: true,    // Animação acontece apenas uma vez
        offset: 50,    // Deslocamento para disparar a animação
    });

    // --- Navegação e Menu Ativo ---
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('section');
    const header = document.getElementById('main-header');

    // Função para destacar o link de navegação ativo durante o scroll
    function changeActiveLink() {
        let index = sections.length;

        while(--index && window.scrollY + header.offsetHeight < sections[index].offsetTop) {}
        
        navLinks.forEach((link) => link.classList.remove('active'));
        // Verifica se o link correspondente à seção atual existe
        if (navLinks[index]) {
            navLinks[index].classList.add('active');
        }
    }

    // Adiciona o listener de scroll para atualizar o link ativo
    window.addEventListener('scroll', changeActiveLink);
    // Chama a função uma vez no carregamento da página
    changeActiveLink();

    // --- Menu Mobile ---
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mainNavUl = document.querySelector('#main-nav ul');

    mobileMenuToggle.addEventListener('click', () => {
        mainNavUl.classList.toggle('active');
    });

    // Fecha o menu mobile ao clicar em um link
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (mainNavUl.classList.contains('active')) {
                mainNavUl.classList.remove('active');
            }
        });
    });

    // --- Processamento do Formulário de Contato com AJAX ---
    const contactForm = document.getElementById('contact-form');
    const formFeedback = document.getElementById('form-feedback');

    contactForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        // Validação básica no front-end
        const name = document.getElementById('nome').value.trim();
        const email = document.getElementById('email').value.trim();
        const subject = document.getElementById('assunto').value.trim();
        const message = document.getElementById('mensagem').value.trim();

        if (!name || !email || !subject || !message) {
            showFeedback('Por favor, preencha todos os campos obrigatórios.', 'error');
            return;
        }

        const formData = new FormData(contactForm);
        showFeedback('Enviando mensagem...', 'loading');

        fetch('processa_formulario.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showFeedback(data.message, 'success');
                contactForm.reset(); // Limpa o formulário
            } else {
                showFeedback(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            showFeedback('Ocorreu um erro ao enviar a mensagem. Tente novamente mais tarde.', 'error');
        });
    });

    // Função auxiliar para exibir feedback do formulário
    function showFeedback(message, type) {
        formFeedback.textContent = message;
        formFeedback.className = type; // Aplica a classe 'success' ou 'error'
    }
});
