<?php
/**
 * @file
 * Contains \Drupal\drupalform\Form\SimpleForm.
 */
namespace Drupal\drupalform\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class SimpleForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'simple_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Candidate Name:'),
      '#required' => TRUE,
    );


    $form['number'] = array (
        '#type' => 'tel',
        '#title' => t('Mobile no'),
        '#required' => TRUE,
    );

    $form['mail'] = array(
      '#type' => 'email',
      '#title' => t('Email ID:'),
      '#required' => TRUE,
    );


    $form['address'] = array (
      '#type' => 'textfield',
      '#title' => t('Address'),
      '#required' => TRUE,
    );


    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        if (strlen($form_state->getValue('number')) < 10) {
            $form_state->setErrorByName('number', $this->t('Mobile number is too short.'));
        }
    }

  /**
   * {@inheritdoc}
   */
    public function submitForm(array &$form, FormStateInterface $form_state) {

        foreach ($form_state->getValues() as $key => $value) {
        \Drupal::messenger()->addMessage($key . ': ' . $value);
        // $post = $form_state->getValues();
        // $connection = \Drupal::service('database');
        // $query = $connection->insert('simple_form')
        //     ->fields([
        //         'name' => $post['name'],
        //         'gender' => $post['gender'],
        //         'phone' => $post['number'],
        //         'email' => $post['mail'],
        //         'address' => $post['address'],
        //         'city' => $post['city'],
        //     ]);
        // $query->execute();
        // \Drupal::messenger()->addMessage('Data saved Successfully');
        }
   }
}