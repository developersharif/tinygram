<?php

it('returns a Error response for unAuthorized User Request', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});
