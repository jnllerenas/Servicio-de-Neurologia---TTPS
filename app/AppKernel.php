<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Neurologia\GenericosBundle\NeurologiaGenericosBundle(),
            new Neurologia\UserBundle\NeurologiaUserBundle(),
            new Neurologia\DiagnosticoBundle\NeurologiaDiagnosticoBundle(),
            new Neurologia\MainBundle\NeurologiaMainBundle(),
            new Neurologia\HistoriaClinicaBundle\NeurologiaHistoriaClinicaBundle(),
            new Neurologia\BDBundle\NeurologiaBDBundle(),	
            new Neurologia\AntecedenteBundle\NeurologiaAntecedenteBundle(),
            new Neurologia\TratamientoBundle\TratamientoBundle(),
            new Neurologia\PacientesBundle\NeurologiaPacientesBundle(),
            new Neurologia\EstudioBundle\NeurologiaEstudioBundle(),
            new Neurologia\TabsBundle\NeurologiaTabsBundle(),	//sacar dps
		    new Ps\PdfBundle\PsPdfBundle(),
            new Neurologia\BusquedaBundle\NeurologiaBusquedaBundle(),
            new Neurologia\EvolucionBundle\EvolucionBundle(),
        );


        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
