<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserInfoType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		##Generieren die benötigen Form Datei
		$builder
			->add('name', TextType::class, ['attr' => [
				'placeholder' => 'Bitte Schreiben Sie Ihr Name']])
			->add('email', EmailType::class, ['attr' => [
				'placeholder' => 'Bitte Schreiben Sie Ihr E-Mail']])
			->add('nachricht', TextareaType::class, ['attr' => [
				'placeholder' => 'Was wollen Sie sagen']])
			->add('submit', SubmitType::class,
				['attr' => array('style' => 'float: right')]);

	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			// Configure your form options here
			'data_class' => User::class,
		]);
	}
}
