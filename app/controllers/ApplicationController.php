<?php

use Scholarship\Forms\ApplicationForm;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ApplicationController extends \BaseController {

  /**
  * @var applicationForm
  */
  protected $applicationForm;

  function __construct(ApplicationForm $applicationForm)
  {
    $this->applicationForm = $applicationForm;

    $this->beforeFilter('currentUser', ['only' => ['edit', 'update']]);

    // Check that the current user doesn't create many applications
    $this->beforeFilter('startedProcess:application', ['only' => ['create']]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    //
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
     //@TODO: need to figure out which scholarship is the current run.  // @TODO: do we need only certain fields?
    $scholarship = Scholarship::firstOrFail(); // ->select(['label_app_accomplishments', 'label_app_activities', 'label_app_essay1', 'label_app_essay2']);
    return View::make('application.create')->with(compact('scholarship'));
  }


  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $user = User::whereId(Auth::user()->id)->firstOrFail();

    $input = Input::all();

    // Only run validation on applications that were submitted
    // (do not run on those 'saved as draft')
    if (isset($input['complete']))
    {
      $this->applicationForm->validate($input);
    }

    // @TODO: there's a better way of doing the following...
    $application = new Application;
    $application->accomplishments = $input['accomplishments'];

    if ($input['gpa'] != '')
    {
      $application->gpa = $input['gpa'];
    }
    if ($input['test_score'] != '')
    {
      $application->test_type = $input['test_type'];
      $application->test_score = $input['test_score'];
    }
    $application->activities = $input['activities'];
    $application->essay1 = $input['essay1'];
    $application->essay2 = $input['essay2'];

    /*@TODO: for now this is just finding the first scholarship
     * this eventually needs to find the 'active' scholarship
     * that is TBD
     */
    $scholarship = Scholarship::firstOrFail();
    $application->scholarship()->associate($scholarship);

    $user->application()->save($application);

    // @TODO: this should go to the recommendation page.
    return Redirect::route('recommendation.create')->with('flash_message', 'Application information has been saved!');
  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $user = User::with('application')->whereId($id)->firstOrFail();
    return View::make('application.show')->withUser($user);
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $user = User::whereId($id)->firstOrFail();
    $scholarship = Scholarship::firstOrFail();
    return View::make('application.edit')->with(compact('user', 'scholarship'));
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {

    $input = Input::except('documentation', 'factual', 'media_release', 'rules');
    // Only run validation on applications that were submitted
    // (do not run on those 'saved as draft')
    if (isset($input['complete']))
    {
      $input = Input::all();
      $this->applicationForm->validate($input);
      // @TODO: once we have validated, are we setting a 'complete' flag on the app to disable edits?
    }
    $application = Application::where('user_id', $id)->firstOrFail();;
    $application->fill($input)->save();
    return Redirect::route('status')->with('flash_message', 'Application information has been saved!');

  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }


}
