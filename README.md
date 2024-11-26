# Excellentwebworld
# Contract Module

This README provides an overview of the custom Drupal module named **Contract**. The module implements all specified functionalities and adheres to Drupal coding standards.

---

## Features

1. **Custom Module**:
   - A module named `contract` to handle contract-related functionality.

2. **Custom Content Type**:
   - Content type: **Contract**
   - Fields:
     - **Title**: Core title field.
     - **Body**: Core body field.
     - **Document Title**: Text field.
     - **Recipient Name**: Text field.
     - **Sender Name**: Text field.
     - **Date**: Date field.
     - **Document File**: File upload field.

3. **Custom Form**:
   - A form with fields matching the `Contract` content type.
   - On submission:
     - Redirects to a confirmation page with a success message.
     - Creates a node of the `Contract` content type with the submitted values.

4. **Custom Template**:
   - A custom template displays all nodes of the `Contract` content type in a table format.

5. **Custom Block**:
   - Displays the custom template on all pages where the block is placed.
   - Dynamically updates data without requiring a manual cache rebuild when nodes are created, updated, or deleted.

---

## Implementation Details

1. **Dependency Injection**:
   - Applied in the custom form and block to ensure modular and maintainable code.

2. **Caching**:
   - Block caching is enabled to improve performance.
   - The block updates dynamically without requiring a manual cache rebuild.

3. **Drupal Coding Standards**:
   - All code adheres to Drupal coding standards and DrupalPractice code standards, verified using **PHP CodeSniffer**.

---

## Installation

1. Clone the repository into the `modules/custom` directory of your Drupal project:
   ```bash
   git clone <repository-url> modules/custom/contract

