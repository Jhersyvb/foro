<?php

use Tests\{CreatesApplication, TestsHelper};

/**
 * @property  defaultUser
 */
abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    use CreatesApplication, TestsHelper;

    public function setUp()
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }
}
