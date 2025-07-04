    <!-- ======= Footer ======= -->
    <footer class="footer">
        <div class="container">
            &copy; Copyright <strong><span>Seu Nome</span></strong>. Todos os direitos reservados
        </div>
    </footer>


    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS (Animate On Scroll) JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Vanilla-Masker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-masker/1.2.0/vanilla-masker.min.js"></script>

    <!-- Script Customizado -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Inicializa a biblioteca AOS (Animate on Scroll)
            AOS.init({
                duration: 1000,
                once: true,
                offset: 50,
            });

            // 2. Adiciona/Remove a classe 'scrolled' na navbar ao rolar a página
            const navbar = document.getElementById('navbar-portfolio');
            if (navbar) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 50) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });
            }

            // 3. Aplica a máscara no campo de telefone usando Vanilla-Masker
            const telefoneInput = document.getElementById('telefone');
            if (telefoneInput) {
                VMasker(telefoneInput).maskPattern('(99) 99999-9999');
            }

            // 4. Validação e ENVIO AJAX do formulário de contato
            const contactForm = document.getElementById('contact-form');
            if (contactForm) {
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

                    switch (field.id) {
                        case 'email':
                            isValid = emailRegex.test(field.value.trim());
                            break;
                        case 'telefone':
                            // ALTERAÇÃO: Remove caracteres não numéricos e verifica o comprimento
                            const phoneDigits = field.value.replace(/\D/g, '');
                            isValid = phoneDigits.length >= 10;
                            break;
                    }
                    return isValid;
                };

                const toggleError = (field, showError) => {
                    const errorDiv = errorDivs[field.id];
                    if (showError) {
                        field.style.borderColor = '#ff4d4d';
                        if(errorDiv) errorDiv.style.display = 'block';
                    } else {
                        field.style.borderColor = '';
                        if(errorDiv) errorDiv.style.display = 'none';
                    }
                };

                // Validação ao perder o foco (blur)
                Object.values(fields).forEach(field => {
                    field.addEventListener('blur', () => {
                        const isValid = validateField(field);
                        toggleError(field, !isValid);
                    });
                });

                // Validação no envio do formulário
                contactForm.addEventListener('submit', function(event) {
                    event.preventDefault();

                    let isFormValid = true;
                    formFeedback.style.display = 'none';

                    // Valida todos os campos antes de enviar
                    Object.values(fields).forEach(field => {
                        const isFieldValid = validateField(field);
                        if (!isFieldValid) {
                            isFormValid = false;
                        }
                        toggleError(field, !isFieldValid);
                    });

                    if (!isFormValid) {
                        return;
                    }

                    const formData = new FormData(contactForm);
                    const originalButtonText = submitButton.innerHTML;
                    
                    submitButton.disabled = true;
                    submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando...';
                    
                    fetch('enviar_email.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text().then(text => ({ ok: response.ok, status: response.status, text })))
                    .then(result => {
                        formFeedback.className = result.ok ? 'success' : 'error';
                        formFeedback.textContent = result.text;
                        formFeedback.style.display = 'block';

                        if (result.ok) {
                            contactForm.reset();
                        }
                    })
                    .catch(error => {
                        console.error('Erro na requisição fetch:', error);
                        formFeedback.className = 'error';
                        formFeedback.textContent = 'Ocorreu um erro de rede. Tente novamente.';
                        formFeedback.style.display = 'block';
                    })
                    .finally(() => {
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalButtonText;
                    });
                });
            }
        });
    </script>
    </body>
</html>
