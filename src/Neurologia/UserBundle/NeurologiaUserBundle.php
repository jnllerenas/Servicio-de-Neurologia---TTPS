<?php

namespace Neurologia\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class NeurologiaUserBundle extends Bundle
{
    public function getParent() {
        return 'FOSUserBundle';
    }
}
