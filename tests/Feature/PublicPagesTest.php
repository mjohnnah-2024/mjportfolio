<?php

test('home page returns 200', function () {
    $this->get(route('home'))->assertOk();
});

test('about page returns 200', function () {
    $this->get(route('about'))->assertOk();
});

test('projects index returns 200', function () {
    $this->get(route('projects.index'))->assertOk();
});

test('ai help page returns 200', function () {
    $this->get(route('ai-help'))->assertOk();
});

test('contact page returns 200', function () {
    $this->get(route('contact'))->assertOk();
});

test('project detail returns 404 for unknown slug', function () {
    $this->get(route('projects.show', 'non-existent-project'))->assertNotFound();
});

test('sitemap returns xml', function () {
    $this->get('/sitemap.xml')
        ->assertOk()
        ->assertHeader('content-type', 'text/xml; charset=UTF-8');
});
