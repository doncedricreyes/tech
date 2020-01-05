@extends('layouts.website')

@section('content')
<div class="home-cont">
    <div class="vid-container">
        <video id="home-vid" src="/storage/images/homeVid.mp4" autoplay="true" muted="true"  loop="true"></video>
    </div>
    <div class="vid-content">
        <h1> &nbsp; " Simple <span>SOLUTIONS</span>,</h1>
        <h1>for Complex <span>CONNECTIONS</span>. ”</h1>
    </div>
    <div class="home-about">
        <div class="intro">
            <h3>VASUS Tech Support</h3><p>VTS is a website that helps you resolve computer problems
                quickly and reliably. We work with many types of IT customers with unique needs and very 
                different budget levels.
            </p>
        </div>
<br> <br>
        <div class="home-about1">
            <div class="intro1">
                <h3>HOW IT WORKS</h3><p>VTS keeps your computer systems smooth, stable, and secure!
                </p>
            </div>


        <div class="grid">
            
            <div>
                
                <div class="overlay">1. SEND TICKET ONLINE <br>
                        Go to www.chuchu.com and send a ticket/complain about your device. Our courteous, 
                        knowledgeable technicians are standing by to help!</div>
                 <img src="/storage/images/sendTix.png">
            </div>
            <div>
              
                <div class="overlay" >2. WAIT FOR THE CONFIRMATION AND ASSIGNED TECHNICIAN  <br>
                                    Our techsupport will check if your warranty is still valid, 
                                    and then we will notify you the assigned technician.</div>
                <img src="/storage/images/Confirmation.png">
            </div>
            <div>
              
                <div class="overlay">3. DEVICE FIXED! <br>
                                 Our trained professionals troubleshoot and fix problems, and 
                                 take measures to prevent future issues.</div>
                <img src="/storage/images/fixed.JPG">
            </div>
        </div>
    </div>
    <br> <br>

    <div class="brands-wrapper">
			<div class="brands" >
                <br><br>
				<h1>Brands we fix</h1><br>
                <h2>We can repair almost any device or computer!</h2> 
                
                <br> <br><br>
				<ul class="brands-list" style="list-style-type:none" >
					<li class="brand-block">
						<img class="brand__img" src="/storage/images/brand-1.gif" alt="" />
                    </li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;       
					<li class="brand-block">
						<img class="brand__img" src="/storage/images/brand-2.gif" alt="" />
					</li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
					<li class="brand-block">
						<img class="brand__img" src="/storage/images/brand-3.gif" alt="" />
					</li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
					<li class="brand-block">
						<img class="brand__img" src="/storage/images/brand-4.gif" alt="" />
					</li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
					<li class="brand-block">
						<img class="brand__img" src="/storage/images/brand-5.gif" alt="" />
					</li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
					<li class="brand-block">
						<img class="brand__img" src="/storage/images/brand-6.gif" alt="" />
					</li>
                </ul>  
                <ul class="brands-list2" style="list-style-type:none">
                    <li class="brand-block">
						<img class="brand__img" src="/storage/images/brand-7.gif" alt="" />
					</li>&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp; 
					<li class="brand-block">
						<img class="brand__img" src="/storage/images/brand-8.gif" alt="" />
					</li>&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp; 
					<li class="brand-block">
						<img class="brand__img" src="/storage/images/brand-9.gif" alt="" />
					</li>&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp; 
					<li class="brand-block">
						<img class="brand__img" src="/storage/images/brand-10.gif" alt="" />
					</li>&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp; 
					<li class="brand-block">
						<img class="brand__img" src="/storage/images/brand-11.gif" alt="" />
					</li>
				</ul>
			</div>
		</div>
    @endsection
</div>
