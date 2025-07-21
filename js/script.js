document.addEventListener('DOMContentLoaded', function() {

    
    AOS.init({
        duration: 800,
        once: true, 
        offset: 50,    
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

// Este evento garante que o script só será executado após o carregamento completo do DOM.
document.addEventListener('DOMContentLoaded', function() {
    
    
    AOS.init({
        duration: 1000, // Duração da animação em milissegundos
        once: true,     // Animação acontece apenas uma vez
        offset: 50,     // Deslocamento (em px) para disparar a animação
    });

    
    const navbar = document.getElementById('navbar-portfolio');
    if (navbar) {
        // Adiciona um listener para o evento de scroll da janela
        window.addEventListener('scroll', () => {
            // Se o scroll vertical for maior que 50px, adiciona a classe
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                // Caso contrário, remove a classe
                navbar.classList.remove('scrolled');
            }
        });
    }

   
    const telefoneInput = document.getElementById('telefone');
    if (telefoneInput) {
        // A máscara se adapta para telefones fixos e celulares com 9º dígito
        VMasker(telefoneInput).maskPattern('(99) 99999-9999');
    }

    
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        // Mapeia os campos do formulário e seus respectivos divs de erro
        const fields = {
            nome: document.getElementById('nome'),
            email: document.getElementById('email'),
            telefone: document.getElementById('telefone'),
            mensagem: document.getElementById('mensagem')
        };

        const errorDivs = {
            nome: document.getElementById('nome-error'),
            email: document.getElementById('email-error'),
            telefone: document.getElementById('telefone-error'),
            mensagem: document.getElementById('mensagem-error')
        };

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const formFeedback = document.getElementById('form-feedback');
        const submitButton = contactForm.querySelector('button[type="submit"]');

        // Função para validar um campo individualmente
        const validateField = (field) => {
            let isValid = field.value.trim() !== '';
            
            if (!isValid) return false;

            // Validações específicas por tipo de campo
            switch (field.id) {
                case 'email':
                    isValid = emailRegex.test(field.value.trim());
                    break;
                case 'telefone':
                    // Remove caracteres não numéricos e verifica o comprimento mínimo
                    const phoneDigits = field.value.replace(/\D/g, '');
                    isValid = phoneDigits.length >= 10;
                    break;
            }
            return isValid;
        };

        // Função para mostrar/ocultar a mensagem de erro de um campo
        const toggleError = (field, showError) => {
            const errorDiv = errorDivs[field.id];
            if (showError) {
                field.style.borderColor = '#ff4d4d'; // Borda vermelha para indicar erro
                if(errorDiv) errorDiv.style.display = 'block';
            } else {
                field.style.borderColor = ''; // Remove a borda de erro
                if(errorDiv) errorDiv.style.display = 'none';
            }
        };

        // Adiciona um listener para cada campo para validar quando o usuário sai do campo (blur)
        Object.values(fields).forEach(field => {
            field.addEventListener('blur', () => {
                const isValid = validateField(field);
                toggleError(field, !isValid);
            });
        });

        // Adiciona o listener para o evento de SUBMIT do formulário
        contactForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Impede o envio padrão (recarregamento da página)

            let isFormValid = true;
            formFeedback.style.display = 'none'; // Oculta feedback anterior

            // Valida todos os campos antes de enviar
            Object.values(fields).forEach(field => {
                const isFieldValid = validateField(field);
                if (!isFieldValid) {
                    isFormValid = false;
                }
                toggleError(field, !isFieldValid);
            });

            // Se o formulário não for válido, interrompe o envio
            if (!isFormValid) {
                return;
            }

            // Prepara para o envio com AJAX
            const formData = new FormData(contactForm);
            const originalButtonText = submitButton.innerHTML;
            
            // Desabilita o botão e mostra um spinner para feedback visual
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando...';
            
            // Envia os dados para o script PHP usando a API Fetch
            fetch('enviar_email.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text().then(text => ({ ok: response.ok, status: response.status, text })))
            .then(result => {
                // Mostra a mensagem de sucesso ou erro retornada pelo PHP
                formFeedback.className = result.ok ? 'success' : 'error';
                formFeedback.textContent = result.text;
                formFeedback.style.display = 'block';

                if (result.ok) {
                    contactForm.reset(); // Limpa o formulário em caso de sucesso
                    // Remove as bordas de erro que possam ter ficado
                     Object.values(fields).forEach(field => toggleError(field, false));
                }
            })
            .catch(error => {
                // Trata erros de rede
                console.error('Erro na requisição fetch:', error);
                formFeedback.className = 'error';
                formFeedback.textContent = 'Ocorreu um erro de rede. Tente novamente.';
                formFeedback.style.display = 'block';
            })
            .finally(() => {
                // Reabilita o botão e restaura o texto original, independente do resultado
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            });
        });
    }
});
