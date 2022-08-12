<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

class Asana_Integration_Action_After_Submit extends \ElementorPro\Modules\Forms\Classes\Action_Base {

	/**
	 * Get Name
	 *
	 * Return the action name
	 *
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'asana integration';
	}

	/**
	 * Get Label
	 *
	 * Returns the action label
	 *
	 * @access public
	 * @return string
	 */
	public function get_label() {
		return __( 'Asana', 'asana-elementor-integration' );
	}

	/**
	 * Register Settings Section
	 *
	 * Registers the Action controls
	 *
	 * @access public
	 * @param \Elementor\Widget_Base $widget
	 */
	public function register_settings_section( $widget ) {
		$widget->start_controls_section(
			'section_asana-elementor-integration',
			[
				'label' => __( 'Asana', 'asana-elementor-integration' ),
				'condition' => [
					'submit_actions' => $this->get_name(),
				],
			]
		);

		$widget->add_control(
			'asana_api',
			[
				'label' => __( 'Asana API key', 'asana-elementor-integration' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => ' 1/803524005230015:86e678fd6...',
				'label_block' => true,
				'separator' => 'before',
				'description' => __( 'Enter your API key from Asana. You can create one <a href="https://app.asana.com/0/my-apps" target="_blank">here</a>. Under Personal access token click on New access token, enter a name and create token. Then past the token here.', 'asana-elementor-integration' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'asana_workspace_id',
			[
				'label' => __( 'Asana workspace ID', 'asana-elementor-integration' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => '1201704174639388',
				'description' => __( 'Enter the workspace id - you can find this <a href="https://app.asana.com/api/1.0/workspaces" target="_blank">here</a> when logged in asana. Copy the gid value here', 'asana-elementor-integration' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'asana_project_id',
			[
				'label' => __( 'Asana project ID', 'asana-elementor-integration' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => '803525545445918',
				'description' => __( 'Enter the project id - you can find this <a href="https://app.asana.com/api/1.0/projects" target="_blank">here</a> when logged in asana. Copy the gid value here', 'asana-elementor-integration' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'asana_assignee_id',
			[
				'label' => __( 'Asana assignee ID', 'asana-elementor-integration' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => '803525545445918',
				'description' => __( 'Enter the assignee id - you can find this <a href="https://app.asana.com/api/1.0/users" target="_blank">here</a> when logged in asana. Copy the gid value here', 'asana-elementor-integration' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'asana_task_name_field',
			[
				'label' => __( 'Task name field ID', 'asana-elementor-integration' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'taskname',
				'separator' => 'before',
				'description' => __( 'Enter the elementor form task name field id - you can find this under the elementor form field advanced tab for example "name".', 'asana-elementor-integration' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'asana_task_description_field',
			[
				'label' => __( 'Task description field ID', 'asana-elementor-integration' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'taskdescription',
				'description' => __( 'Enter the elementor form task description field id - you can find this under the elementor form field advanced tab for example "message".', 'asana-elementor-integration' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'asana_due_date',
			[
				'label' => __( 'Due date', 'asana-elementor-integration' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'placeholder' => '30',
				'description' => __( 'Enter the amount of days for the task due date. - for example when set to 30. Due date will be set today +30 days. When empty it will set +30 days. When set to 0 it will be set to today', 'asana-elementor-integration' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'need_help_note',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __('Need help? <a href="https://plugins.webtica.be/support/?ref=plugin-widget" target="_blank">Check out our support page.</a>', 'asana-elementor-integration'),
			]
		);

		$widget->end_controls_section();

	}

	/**
	 * On Export
	 *
	 * Clears form settings on export
	 * @access Public
	 * @param array $element
	 */
	public function on_export( $element ) {
		unset(
			$element['asana_api'],
			$element['asana_workspace_id'],
			$element['asana_project_id'],
			$element['asana_assignee_id'],
			$element['asana_due_date'],
			$element['asana_task_name_field'],
			$element['asana_task_description_field']
		);

		return $element;
	}

	/**
	 * Run
	 *
	 * Runs the action after submit
	 *
	 * @access public
	 * @param \ElementorPro\Modules\Forms\Classes\Form_Record $record
	 * @param \ElementorPro\Modules\Forms\Classes\Ajax_Handler $ajax_handler
	 */
	public function run( $record, $ajax_handler ) {
		$settings = $record->get( 'form_settings' );

		//  Make sure that there is an Asana API key set
		if ( empty( $settings['asana_api'] ) ) {
			return;
		}
		//  Make sure that there is an workspace set
		if ( empty( $settings['asana_workspace_id'] ) ) {
			return;
		}
		//  Make sure that there is an project set
		if ( empty( $settings['asana_project_id'] ) ) {
			return;
		}
		//  Make sure that there is a task name set
		if ( empty( $settings['asana_task_name_field'] ) ) {
			return;
		}

		// Get submitted Form data
		$raw_fields = $record->get( 'fields' );

		// Normalize the Form Data
		$fields = [];
		foreach ( $raw_fields as $id => $field ) {
			$fields[ $id ] = $field['value'];
		}

		//Generate due date 
		if (!empty($settings['asana_due_date'])){
			$days = $settings['asana_due_date'];
			$duedate = date("Y-m-d", strtotime("+$days days"));
		}
		if ($settings['asana_due_date'] == "0"){
			$duedate = date("Y-m-d");
		}
		else {
			$duedate = date("Y-m-d", strtotime("+30 days"));
		}

		//Generate array to send
		$datatosend = [
			"data" => [
				  "due_on" => $duedate, 
				  "assignee" => $settings['asana_assignee_id'], 
				  "name" => $fields[$settings['asana_task_name_field']], 
				  "notes" => $fields[$settings['asana_task_description_field']], 
				  "projects" => [
					$settings['asana_project_id']
				  ], 
				  "workspace" => $settings['asana_workspace_id'] 
			   ] 
		 ]; 
		
		//Send data to Asana
		wp_remote_post( 'https://app.asana.com/api/1.0/tasks', array(
			'method'      => 'POST',
		    'timeout'     => 45,
		    'httpversion' => '1.0',
		    'blocking'    => false,
		    'headers'     => [
	            'accept' => 'application/json',
		    	'content-Type' => 'application/json',
	            'Authorization' => 'Bearer ' . $settings['asana_api'],
		    ],
		    'body'        => json_encode($datatosend)
			)
		);	
	}
}