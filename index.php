<?php include 'header.php'; ?>

<main>
    <!-- ======= Seção Início ======= -->
    <section id="inicio">
        <div class="container">
            <div class="row align-items-center justify-content-center gy-5">
                <div class="col-lg-6 text-center text-lg-start">
                    <div data-aos="fade-right">
                        <p class="lead mb-2">Olá, eu sou</p>
                        <h1 class="display-3 fw-bold">João Vitor</h1>
                        <p class="profession mb-4">Desenvolvedor Web</p>
                        <a href="#projetos" class="btn btn-primary-custom me-2">Ver Projetos</a>
                        <a href="#contato" class="btn btn-secondary-custom">Entrar em Contato</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://placehold.co/400x400/0e0e0e/005A9C?text=Sua+Foto"
                        alt="Foto de perfil"
                        class="img-fluid profile-img"
                        data-aos="fade-left">
                </div>
            </div>
        </div>
    </section>

    <!-- ======= Seção Sobre Mim ======= -->
    <section id="sobre" class="section-padding">
        <div class="container">
            <div data-aos="fade-up">
                <h2 class="section-title">Sobre Mim</h2>
                <p>
                    Insira aqui um parágrafo cativante sobre você. Fale sobre sua paixão por tecnologia, sua jornada profissional, seus objetivos e o que te motiva. Destaque suas principais qualidades como profissional e como pessoa. Mantenha o texto conciso, mas informativo.
                </p>
            </div>
        </div>
    </section>

    <!-- ======= Seção Habilidades ======= -->
    <section id="habilidades" class="section-padding bg-dark">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Habilidades</h2>
            <div class="row gy-4 justify-content-center">
                <div class="col-md-4 col-lg-3" data-aos="zoom-in">
                    <div class="skill-card">
                        <i class="fab fa-php"></i>
                        <h3>PHP</h3>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="100">
                    <div class="skill-card">
                        <i class="fab fa-js-square"></i>
                        <h3>JavaScript</h3>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="200">
                    <div class="skill-card">
                        <i class="fab fa-html5"></i>
                        <h3>HTML5</h3>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
                    <div class="skill-card">
                        <i class="fab fa-css3-alt"></i>
                        <h3>CSS3</h3>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="400">
                    <div class="skill-card">
                        <i class="fab fa-bootstrap"></i>
                        <h3>Bootstrap 5</h3>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="500">
                    <div class="skill-card">
                        <i class="fas fa-database"></i>
                        <h3>SQL</h3>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="600">
                    <div class="skill-card">
                        <i class="fab fa-git-alt"></i>
                        <h3>Git</h3>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="700">
                    <div class="skill-card">
                        <i class="fa-brands fa-node"></i>
                        <h3>Node</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======= Seção Projetos ======= -->
    <section id="projetos" class="section-padding">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Projetos</h2>
            <div class="row gy-4 justify-content-center">
                <!-- Projeto 1 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div class="project-card">
                        <img src="img/SpeedScarf.png" alt="Imagem do Projeto 1">
                        <div class="project-card-body">
                            <h3>Speed Scarf</h3>
                            <p class="project-tech">Tecnologias: HTML, CSS, JavaScript</p>
                            <a href="https://joaovitormcz.github.io/Projeto-TechAcademy/" target="_blank" class="project-link">
                                <i class="fas fa-external-link-alt"></i> Ver Site
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Projeto 2 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="project-card">
                        <img src="img/CarinaMelo.png" alt="Imagem do Projeto 2">
                        <div class="project-card-body">
                            <h3>Carina Melo SemiJoias</h3>
                            <p class="project-tech">Tecnologias: PHP, CSS, JavaScript, Bootstrap</p>
                            <a href="https://carina-melo.infinityfreeapp.com/home" target="_blank" class="project-link">
                                <i class="fas fa-external-link-alt"></i> Ver Site
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======= Seção Contato ======= -->
    <section id="contato" class="section-padding bg-dark">
        <div class="container">
            <div data-aos="fade-up">
                <h2 class="section-title">Contato</h2>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <form id="contact-form" action="enviar_email.php" method="POST" novalidate>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome completo" required>
                                <div class="form-error" id="nome-error">Por favor, insira seu nome.</div>
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu melhor e-mail" required>
                                <div class="form-error" id="email-error">Por favor, insira um e-mail válido.</div>
                            </div>
                            <!-- Dentro do <form id="contact-form"> -->

                            <div class="mb-3">
                                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Digite seu telefone" required>
                                <div class="form-error" id="telefone-error">Por favor, insira um telefone válido.</div>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" id="mensagem" name="mensagem" rows="5" placeholder="Deixe sua mensagem" required></textarea>
                                <div class="form-error" id="mensagem-error">Por favor, escreva uma mensagem.</div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary-custom">Enviar Mensagem</button>
                            </div>
                        </form>
                        <div id="form-feedback" class="mt-4"></div>

                        <div class="text-center mt-5 social-icons">
                            <a href="#" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            <a href="#" target="_blank" aria-label="GitHub"><i class="fab fa-github"></i></a>
                            <a href="#" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>