<?php

it('returns a successful response on portal page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Portal Layanan Keperawatan');
    $response->assertSee('Aplikasi Nurse Recharge');
    $response->assertSee('Aplikasi Supervisi');
});
