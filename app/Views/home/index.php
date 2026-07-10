<?php
$navbarLinks = [
    ['label' => 'Home', 'href' => '#home'],
    ['label' => 'Courses', 'href' => '#courses'],
    ['label' => 'Categories', 'href' => '#categories'],
    ['label' => 'Community', 'href' => '#community'],
    ['label' => 'About', 'href' => '#about'],
    ['label' => 'Contact', 'href' => '#contact'],
];
$links = $navbarLinks;
?>

<section id="home" class="hero-shell position-relative overflow-hidden py-4 py-lg-5">
    <?php include dirname(__DIR__) . '/components/navbar.php'; ?>

    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-7 animate-slide-up">
                <div class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2 mb-4">
                    <i class="bi bi-stars me-2"></i> Premium learning experience
                </div>
                <h1 class="display-4 fw-bold mb-4 lh-1">Learn Without Limits</h1>
                <p class="lead text-muted mb-4">Build practical skills that transform your career and your future with a learning platform designed for ambitious professionals.</p>
                <div class="d-flex flex-wrap gap-3 mb-5">
                    <?php
                    $label = 'Explore Courses';
                    $variant = 'primary';
                    $size = 'lg';
                    $pill = true;
                    $href = '#courses';
                    include dirname(__DIR__) . '/components/buttons.php';
                    ?>
                    <?php
                    $label = 'Start Learning';
                    $variant = 'outline-primary';
                    $size = 'lg';
                    $pill = true;
                    $href = '#categories';
                    include dirname(__DIR__) . '/components/buttons.php';
                    ?>
                </div>
                <div class="row g-3 stats-row">
                    <div class="col-sm-4">
                        <div class="glass-card rounded-4 p-3">
                            <h3 class="fw-bold mb-1 counter" data-target="1000">0</h3>
                            <p class="text-muted mb-0">Students</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="glass-card rounded-4 p-3">
                            <h3 class="fw-bold mb-1 counter" data-target="100">0</h3>
                            <p class="text-muted mb-0">Lessons</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="glass-card rounded-4 p-3">
                            <h3 class="fw-bold mb-1 counter" data-target="25">0</h3>
                            <p class="text-muted mb-0">Expert Trainers</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 animate-fade-in">
                <div class="hero-visual glass-card rounded-4 p-4 p-lg-5 position-relative">
                    <img loading="lazy" src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=900&q=80" alt="A professional learning environment" class="img-fluid rounded-4 shadow-sm">
                    <div class="position-absolute bottom-0 start-0 m-4 glass-card rounded-4 p-3">
                        <div class="fw-semibold">6+ Professional Courses</div>
                        <div class="small text-muted">Designed for modern career growth</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="search" class="container py-5">
    <div class="glass-card rounded-4 p-4 p-lg-5 animate-slide-up">
        <div class="row g-3 align-items-end">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-2">Find the right course</h2>
                <p class="text-muted mb-0">Search by topic, skill, and format to jump into your next learning milestone.</p>
            </div>
            <div class="col-lg-6">
                <div class="row g-2">
                    <div class="col-md-6">
                        <input type="text" class="form-control form-control-lg" placeholder="Search courses" aria-label="Search courses">
                    </div>
                    <div class="col-md-4">
                        <select class="form-select form-select-lg" aria-label="Select category">
                            <option selected>Category</option>
                            <option value="1">Technology</option>
                            <option value="2">Business</option>
                            <option value="3">Agriculture</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-lg w-100">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="categories" class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Popular Categories</h2>
            <p class="text-muted mb-0">Choose a field that matches your ambitions.</p>
        </div>
    </div>
    <div class="row g-4">
        <?php foreach ($categories as $category): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card glass-card h-100 border-0 shadow-sm category-card">
                    <div class="card-body p-4">
                        <div class="icon-badge mb-3"><i class="<?= htmlspecialchars($category['icon']) ?>"></i></div>
                        <h5 class="fw-semibold mb-2"><?= htmlspecialchars($category['title']) ?></h5>
                        <p class="text-muted small mb-3"><?= htmlspecialchars($category['description']) ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary small fw-semibold"><?= htmlspecialchars($category['count']) ?></span>
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">Explore</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section id="courses" class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Featured Courses</h2>
            <p class="text-muted mb-0">Premium curriculum curated for real-world progress.</p>
        </div>
    </div>
    <div class="row g-4">
        <?php foreach ($courses as $course): ?>
            <div class="col-lg-4">
                <div class="card glass-card h-100 border-0 shadow-sm overflow-hidden course-card">
                    <img loading="lazy" src="<?= htmlspecialchars($course['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($course['title']) ?>" style="height: 220px; object-fit: cover;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge rounded-pill bg-primary-subtle text-primary"><?= htmlspecialchars($course['badge']) ?></span>
                            <span class="small text-muted"><?= htmlspecialchars($course['difficulty']) ?></span>
                        </div>
                        <h5 class="fw-semibold mb-2"><?= htmlspecialchars($course['title']) ?></h5>
                        <p class="text-muted small mb-3">By <?= htmlspecialchars($course['instructor']) ?></p>
                        <div class="d-flex flex-wrap gap-2 small text-muted mb-3">
                            <span><i class="bi bi-star-fill text-warning"></i> <?= htmlspecialchars($course['rating']) ?></span>
                            <span><i class="bi bi-people"></i> <?= htmlspecialchars($course['students']) ?></span>
                            <span><i class="bi bi-journals"></i> <?= htmlspecialchars($course['lessons']) ?> lessons</span>
                            <span><i class="bi bi-clock"></i> <?= htmlspecialchars($course['duration']) ?></span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold"><?= htmlspecialchars($course['price']) ?></span>
                            <a href="#" class="btn btn-outline-primary btn-sm rounded-pill">Enroll</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section id="about" class="container py-5">
    <div class="row g-4">
        <div class="col-lg-6">
            <h2 class="fw-bold mb-3">Why Learn.Amani</h2>
            <p class="text-muted mb-4">A premium educational experience crafted for individuals and teams that want ambitious, practical growth.</p>
            <div class="row g-3">
                <?php foreach ($features as $feature): ?>
                    <div class="col-md-6">
                        <div class="card glass-card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <div class="icon-badge mb-3"><i class="<?= htmlspecialchars($feature['icon']) ?>"></i></div>
                                <h6 class="fw-semibold mb-2"><?= htmlspecialchars($feature['title']) ?></h6>
                                <p class="text-muted small mb-0"><?= htmlspecialchars($feature['text']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="glass-card rounded-4 p-4 p-lg-5 h-100">
                <h3 class="fw-bold mb-4">Learning Path</h3>
                <div class="timeline">
                    <?php foreach ($timeline as $item): ?>
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div>
                                <div class="fw-semibold"><?= htmlspecialchars($item['phase']) ?></div>
                                <div class="text-primary small fw-semibold"><?= htmlspecialchars($item['title']) ?></div>
                                <p class="text-muted small mb-0"><?= htmlspecialchars($item['text']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="community" class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">What learners say</h2>
            <p class="text-muted mb-0">Trusted by ambitious professionals seeking measurable growth.</p>
        </div>
    </div>
    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($testimonials as $index => $testimonial): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <div class="card glass-card border-0 shadow-sm p-4 p-lg-5">
                        <div class="d-flex align-items-center mb-4">
                            <img loading="lazy" src="<?= htmlspecialchars($testimonial['avatar']) ?>" alt="<?= htmlspecialchars($testimonial['name']) ?>" class="rounded-circle me-3" style="width: 58px; height: 58px; object-fit: cover;">
                            <div>
                                <h5 class="fw-semibold mb-1"><?= htmlspecialchars($testimonial['name']) ?></h5>
                                <p class="text-muted small mb-0"><?= htmlspecialchars($testimonial['country']) ?></p>
                            </div>
                        </div>
                        <div class="text-warning mb-3">
                            <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                                <i class="bi bi-star-fill"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="lead mb-0">“<?= htmlspecialchars($testimonial['quote']) ?>”</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="container py-5">
    <div class="glass-card rounded-4 p-4 p-lg-5">
        <div class="row g-4 align-items-center">
            <div class="col-lg-3">
                <h4 class="fw-bold mb-1">Trusted by teams and partners</h4>
            </div>
            <div class="col-lg-9">
                <div class="row g-3 align-items-center">
                    <?php foreach ($partners as $partner): ?>
                        <div class="col-6 col-md-4 col-lg-2">
                            <div class="partner-pill text-center text-muted fw-semibold small py-3 rounded-pill glass-card"><?= htmlspecialchars($partner) ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contact" class="container py-5">
    <div class="newsletter-shell glass-card rounded-4 p-4 p-lg-5 text-center">
        <h2 class="fw-bold mb-3">Join thousands of learners</h2>
        <p class="text-muted mb-4">Stay ahead with curated resources, inspiring stories, and new courses.</p>
        <div class="row justify-content-center g-2">
            <div class="col-md-6 col-lg-5">
                <input type="email" class="form-control form-control-lg" placeholder="Email address" aria-label="Email address">
            </div>
            <div class="col-md-3 col-lg-2">
                <button class="btn btn-primary btn-lg w-100">Subscribe</button>
            </div>
        </div>
    </div>
</section>

<?php include dirname(__DIR__) . '/components/footer.php'; ?>
