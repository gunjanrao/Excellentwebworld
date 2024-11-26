<?php

namespace Drupal\example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

/**
 * Form for creating Contract nodes.
 */
class ContractForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'contract_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#required' => TRUE,
    ];

    $form['body'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Body'),
      '#required' => TRUE,
    ];

    $form['document_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Document Title'),
      '#required' => TRUE,
    ];

    $form['recipient_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Recipient Name'),
      '#required' => TRUE,
    ];

    $form['sender_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sender Name'),
      '#required' => TRUE,
    ];

    $form['date'] = [
      '#type' => 'date',
      '#title' => $this->t('Date'),
      '#required' => TRUE,
    ];

    $form['document_file'] = [
      '#type' => 'file',
      '#title' => $this->t('Document File'),
      '#required' => TRUE,
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $values = $form_state->getValues();

    // Create a node.
    $node = Node::create([
      'type' => 'contract',
      'title' => $values['title'],
      'body' => $values['body'],
      'field_document_title' => $values['document_title'],
      'field_sender_name' => $values['sender_name'],
      'field_date' => $values['date'],
      'field_document_file' => $values['document_file'],
    ]);
    $node->save();

    $this->messenger()->addMessage($this->t('Contract created successfully.'));
    $form_state->setRedirect('<front>');

  }

}
