<?php

use Scholarship\Forms\SettingsForm;

class SettingsController extends \BaseController {

  /**
   * @var SettingsForm
   */
  protected $settingsForm;

  function __construct(SettingsForm $settingsForm)
  {
    $this->settingsForm = $settingsForm;
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @return Response
   */
  public function editAppearance()
  {
    $settings = Setting::whereCategory('appearance')->get();

    return View::make('admin.appearance.edit', compact('settings'));
  }


  /**
   * Update the specified resource in storage.
   *
   * @return Response
   */
  public function updateAppearance()
  {
    $input = Input::only('primary_color', 'primary_color_contrast', 'secondary_color', 'secondary_color_contrast', 'cap_color', 'cap_color_contrast');
    $this->settingsForm->validate($input);

    $settings = Setting::whereCategory('appearance')->get();
    $settings->each(function($setting) use($input)
    {
      $setting->value = $input[$setting->key];
      $setting->save();
    });

    // Create the custom stylesheet file from values in Appearance settings.
    createCustomStylesheet($input);

    return Redirect::route('appearance.edit')->with('flash_message', 'Appearance settings have been saved!');

  }

}