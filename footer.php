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
                duration: 1000, // Duração da animação em ms
                once: true, // Animação acontece apenas uma vez
                offset: 50, // Offset (em px) do ponto de gatilho original
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

            // 4. Validação do formulário de contato em tempo real
            const contactForm = document.getElementById('contact-form');
            if (contactForm) {
                const fields = {
                    nome: document.getElementById('nome'),
                    email: document.getElementById('email'),
                    telefone: document.getElementById('telefone'), // <--- Adicionado
                    mensagem: document.getElementById('mensagem')
                };

                const errorDivs = {
                    nome: document.getElementById('nome-error'),
                    email: document.getElementById('email-error'),
                    telefone: document.getElementById('telefone-error'), // <--- Adicionado
                    mensagem: document.getElementById('mensagem-error')
                };

                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                // Função para mostrar/ocultar erro
                const toggleError = (field, showError) => {
                    if (showError) {
                        field.style.borderColor = '#ff4d4d';
                        errorDivs[field.id].style.display = 'block';
                    } else {
                        field.style.borderColor = '';
                        errorDivs[field.id].style.display = 'none';
                    }
                };

                // Validação ao perder o foco
                Object.values(fields).forEach(field => {
                    field.addEventListener('blur', () => {
                        let isValid = true;
                        if (field.value.trim() === '') {
                            isValid = false;
                        }
                        if (field.id === 'email' && !emailRegex.test(field.value.trim())) {
                            isValid = false;
                        }
                        toggleError(field, !isValid);
                    });
                });

                // Validação no envio
                contactForm.addEventListener('submit', function(event) {
                    let isFormValid = true;

                    // Valida todos os campos obrigatórios
                    Object.values(fields).forEach(field => {
                        let isFieldValid = true;
                        if (field.value.trim() === '') {
                            isFieldValid = false;
                        }
                        if (field.id === 'email' && !emailRegex.test(field.value.trim())) {
                            isFieldValid = false;
                        }

                        if (!isFieldValid) {
                            isFormValid = false;
                            toggleError(field, true);
                        } else {
                            toggleError(field, false);
                        }
                    });

                    if (!isFormValid) {
                        event.preventDefault(); // Impede o envio do formulário se for inválido
                        console.log('Formulário inválido. Envio bloqueado.');
                    }
                });
            }
        });
    </script>
    </body>

    </html>