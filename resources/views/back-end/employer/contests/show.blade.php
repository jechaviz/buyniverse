@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
	<div class="wt-haslayout wt-dbsectionspace la-manage-jobs-holder">
		<div class="manage-jobs">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<a href="{{ route('contests.start', $contest->id) }}"><button class="wt-btn">Start Contest</button>
					<div class="wt-rightarea" style="margin-bottom: 24px;">
						<a href="{{ route('contests.edit', $contest->id) }}"><button class="wt-btn">Edit Contest</button>
					</div>
					<div class="wt-dashboardbox">
						<div class="wt-dashboardboxtitle">
							<h2>Contest Details</h2>
						</div>
						<div class="wt-dashboardboxcontent wt-jobdetailsholder">
							<table class="wt-tablecategories">
								<!--<thead>
									<tr>
										<th>Quiz</th> 
										<th>Action</th>
									</tr>
								</thead> -->
								<tbody>
									<tr>
										<td>
											<span class="bt-content">Job Title</span>
										</td> 
										<td>
											<span class="bt-content">{{ $contest->title }}</span> 
										</td>
									</tr>
									<tr>
										<td>
											<span class="bt-content">Start Date</span>
										</td> 
										<td>
											<span class="bt-content">{{ $contest->start_date }}</span> 
										</td>
									</tr>
									<tr>
										<td>
											<span class="bt-content">End Date</span>
										</td> 
										<td>
											<span class="bt-content">{{ $contest->end_date }}</span> 
										</td>
									</tr>
									<tr>
										<td>
											<span class="bt-content">Show name of participants</span>
										</td> 
										<td>
											<span class="bt-content">{{ $contest->show_participant }}</span> 
										</td>
									</tr>
									<tr>
										<td>
											<span class="bt-content">Show the list of participants to the freelancer</span>
										</td> 
										<td>
											<span class="bt-content">{{ $contest->show_participant_to_freelancer }}</span> 
										</td>
									</tr>
									<tr>
										<td>
											<span class="bt-content">Show participant offers to the freelancer</span>
										</td> 
										<td>
											<span class="bt-content">{{ $contest->show_participant_offer_to_freelancer }}</span> 
										</td>
									</tr>
									<tr>
										<td>
											<span class="bt-content">Time limit for the freelancer to send a better offer</span>
										</td> 
										<td>
											<span class="bt-content">{{ $contest->time_limit }} Minutes</span> 
										</td>
									</tr>
									<tr>
										<td>
											<span class="bt-content">Make your own automatic bid to encourage freelancers to lower their costs.<br>If your offer is matched, you will offer a lower offer at a random time. Do you want to include your own automatic offer?</span>
										</td> 
										<td>
											<span class="bt-content">{{ $contest->automatic_offer }}</span> 
										</td>
									</tr>
									<tr>
										<td>
											<span class="bt-content">How do you want your offer to be given?</span>
										</td> 
										<td>
											<span class="bt-content">{{ $contest->automatic_offer_choice }}</span> 
										</td>
									</tr>
									<tr>
										<td>
											<span class="bt-content">Percentage/Amount for automatic bid</span>
										</td> 
										<td>
											<span class="bt-content">{{ $contest->automatic_offer_value }}</span> 
										</td>
									</tr>
									<tr>
										<td>
											<span class="bt-content">Number of freelancer Award allowed</span>
										</td> 
										<td>
											<span class="bt-content">{{ $contest->awarded_allowed }}</span> 
										</td>
									</tr>
									
								</tbody>
							</table>
						</div>
					</div>
					




				</div>
			</div>
		</div>
	</div>
@endsection
