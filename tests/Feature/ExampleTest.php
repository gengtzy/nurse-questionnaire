<?php

it('returns a successful response on portal page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Portal Layanan Keperawatan');
    $response->assertSee('Aplikasi Nurse Recharge');
    $response->assertSee('Supervisi Keperawatan');
    $response->assertSee('https://supervisi-keperawatan-ruang-ubk-2-1.ai.studio/');
});
