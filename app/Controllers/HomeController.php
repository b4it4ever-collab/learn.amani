<?php

namespace App\Controllers;

use App\Core\BaseController;

class HomeController extends BaseController
{
    public function index(): void
    {
        $data = [
            'title' => 'Learn.Amani | Premium Learning Experience',
            'categories' => [
                ['icon' => 'bi bi-flower2', 'title' => 'Agriculture', 'description' => 'Modern farm operations and agri-tech methods.', 'count' => '36 courses'],
                ['icon' => 'bi bi-cpu', 'title' => 'Technology', 'description' => 'Cutting-edge coding and digital product learning.', 'count' => '52 courses'],
                ['icon' => 'bi bi-briefcase', 'title' => 'Business', 'description' => 'Leadership, strategy, and growth essentials.', 'count' => '28 courses'],
                ['icon' => 'bi bi-basket3', 'title' => 'Poultry', 'description' => 'Practical guidance for modern poultry operations.', 'count' => '19 courses'],
                ['icon' => 'bi bi-scissors', 'title' => 'Crocheting', 'description' => 'Creative techniques for handmade mastery.', 'count' => '14 courses'],
                ['icon' => 'bi bi-translate', 'title' => 'English', 'description' => 'Communication skills for global careers.', 'count' => '22 courses'],
            ],
            'courses' => [
                ['image' => 'https://images.unsplash.com/photo-1516321497487-e288fb19713f?auto=format&fit=crop&w=900&q=80', 'badge' => 'Popular', 'difficulty' => 'Intermediate', 'title' => 'AI for Modern Teams', 'instructor' => 'Lina Okafor', 'rating' => '4.9', 'students' => '8.4k', 'lessons' => '24', 'duration' => '6 weeks', 'price' => '$89'],
                ['image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=900&q=80', 'badge' => 'New', 'difficulty' => 'Beginner', 'title' => 'Product Strategy Essentials', 'instructor' => 'Amina Hassan', 'rating' => '4.8', 'students' => '5.1k', 'lessons' => '18', 'duration' => '4 weeks', 'price' => '$59'],
                ['image' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=900&q=80', 'badge' => 'Trending', 'difficulty' => 'Advanced', 'title' => 'Leadership in Practice', 'instructor' => 'Noah Kibet', 'rating' => '4.9', 'students' => '3.6k', 'lessons' => '32', 'duration' => '8 weeks', 'price' => '$99'],
            ],
            'features' => [
                ['icon' => 'bi bi-person-workspace', 'title' => 'Expert Trainers', 'text' => 'Learn from practitioners shaping modern industries.'],
                ['icon' => 'bi bi-lightning-charge', 'title' => 'Practical Learning', 'text' => 'Hands-on lessons designed to create real momentum.'],
                ['icon' => 'bi bi-award', 'title' => 'Certificates', 'text' => 'Recognize progress with credentials that matter.'],
                ['icon' => 'bi bi-people', 'title' => 'Community', 'text' => 'Join a network of ambitious learners and mentors.'],
                ['icon' => 'bi bi-clock-history', 'title' => 'Flexible Learning', 'text' => 'Study on your schedule with guided milestones.'],
                ['icon' => 'bi bi-graph-up-arrow', 'title' => 'Career Growth', 'text' => 'Advance your skills with tomorrow-ready outcomes.'],
            ],
            'timeline' => [
                ['phase' => 'Beginner', 'title' => 'Foundation', 'text' => 'Build confidence through guided essentials.'],
                ['phase' => 'Intermediate', 'title' => 'Apply Skills', 'text' => 'Work on practical challenges and real-world tasks.'],
                ['phase' => 'Advanced', 'title' => 'Lead with Insight', 'text' => 'Move from execution to strategy and influence.'],
                ['phase' => 'Professional', 'title' => 'Career Ready', 'text' => 'Showcase your work with a portfolio-ready outcome.'],
            ],
            'testimonials' => [
                ['name' => 'Maya Tembo', 'country' => 'Kenya', 'quote' => 'The learning experience felt premium from day one. Every module was clear and practical.', 'rating' => 5, 'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=300&q=80'],
                ['name' => 'Daniel Njoroge', 'country' => 'Uganda', 'quote' => 'I finally found a platform that blends depth, flexibility, and beautiful design.', 'rating' => 5, 'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=300&q=80'],
            ],
            'partners' => ['Coursera', 'Udemy', 'LinkedIn Learning', 'Skillshare', 'Google', 'Microsoft'],
        ];

        $this->view('home.index', $data);
    }
}
