@include('components.header')

  
  <div style="width: 100%; margin-top: 80px; height: 607.5px; position: relative; overflow: hidden">
    <img 
      style="width: 450px; height: 450px; left: 85.31px; top: 66.94px; position: absolute; border-radius: 28.13px" 
      src="{{ asset('storage/' . $event->image) }}" 
      alt="Royal Wedding Setup Image"
    />

    <div class="rating-badge">
      <svg class="rating-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
      </svg>
      <span style="margin-right: 5px">{{ $event->rating }}</span>
    </div>

    <div style="left: 668.63px; top: 144px; position: absolute; color: gray; font-size: 16px; font-family: Inter; font-weight: 500; line-height: 29.53px; word-wrap: break-word">
      {{ $event->rating_count }} Ratings & Reviews
    </div>

    <div style="left: 577.5px; top: 78.75px; position: absolute; color: black; font-size: 36px; font-family: Inter; font-weight: 600; line-height: 54px; word-wrap: break-word">
      {{ $event->title }}
    </div>

    <div style="left: 577.5px; top: 190.13px; position: absolute; color: black; font-size: 28.13px; font-family: Inter; font-weight: 500; line-height: 42.19px; word-wrap: break-word">
      ₹ {{ $event->price}}
    </div>

    <div style="left: 702.38px; margin-left: 40px; top: 196.31px; position: absolute; color: lightgray; font-size: 18px; font-family: Inter; font-weight: 500; text-decoration: line-through; line-height: 29.53px; word-wrap: break-word">
      ₹ {{ $event->price + 1000}}
    </div>

    <div style="
      max-width: calc(100% - 615px); 
      left: 577.5px; 
      top: 269.44px; 
      position: absolute; 
      color: #838383; 
      font-size: 15.75px; 
      font-family: Inter; 
      font-weight: 500; 
      line-height: 23.63px; 
      word-wrap: break-word; 
      padding-right: 37.5px;
      box-sizing: border-box;">
      {{ $event->description }}
    </div>

    <div style="position: absolute; top: 459.56px; right: 37.5px; display: flex; align-items: center; gap: 15px;">
      <div style="width: 28.13px; height: 25.51px; margin-right: 15px">
        <img 
          src="{{ asset('assets/images/Icons/like_gray.png') }}" 
          alt="Like Icon" 
          style="cursor: pointer; transition: transform 0.3s ease;" 
          onmouseover="this.style.transform='scale(1.2)'" 
          onmouseout="this.style.transform='scale(1)'"
        >
      </div>

      <div style="width: 28.13px; height: 28.55px; margin-right: 15px">
        <img 
          src="{{ asset('assets/images/Icons/cart_gray.png') }}" 
          alt="Cart Icon" 
          style="cursor: pointer; transition: transform 0.3s ease;" 
          onmouseover="this.style.transform='scale(1.2)'" 
          onmouseout="this.style.transform='scale(1)'"
        >
      </div>

      <button style="
        width: 300.56px;
        height: 57.38px;
        background: #DBFFDE;
        border: 1px solid #D9D9D9;
        border-radius: 28.13px;
        font-size: 22.5px;
        font-family: Inter, sans-serif;
        font-weight: 500;
        line-height: 40.5px;
        color: black;
        cursor: pointer;
      ">
        Book Now
      </button>
    </div>

    <!-- Reviews Section -->
    
  </div>

  <!-- Separation Wrapper -->
<div style=" border-top: 1px solid #dee2e6; background: #f9fafb; border-radius: 24px 24px 0 0;">


  <!-- Reviews Section -->
<div style=" padding: 48px">
  <h2 style="font-size: 24px; font-weight: 700;  margin: 0 10px; font-family: 'Inter', sans-serif;">Reviews & Ratings</h2>

  @if($event->feedback->count() > 0)
    @foreach($event->feedback as $feedback)
      <div style="
        background: #ffffff;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        display: flex;
        gap: 16px;
        align-items: flex-start;
        transition: transform 0.2s ease;
      " 
      onmouseover="this.style.transform='translateY(-4px)'"
      onmouseout="this.style.transform='translateY(0)'"
      >
        <!-- Avatar -->
        <div style="
          width: 56px;
          height: 56px;
          border-radius: 50%;
          background: linear-gradient(135deg, #e0e0e0, #f8f8f8);
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 20px;
          color: #495057;
          font-weight: 600;
        ">
          {{ strtoupper(substr($feedback->user->name, 0, 1)) }}
        </div>

        <!-- Review Content -->
        <div style="flex: 1;">
          <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="font-weight: 600; font-size: 16px; color: #212529; font-family: 'Inter', sans-serif;">
              {{ $feedback->user->name }}
            </span>
            <!-- Rating Stars -->
            <div style="display: flex; gap: 2px;">
              @for($i = 1; $i <= 5; $i++)
                <svg style="width: 18px; height: 18px; fill: {{ $i <= $feedback->rating ? '#FFC107' : '#E4E5E9' }}" viewBox="0 0 24 24">
                  <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                </svg>
              @endfor
            </div>
          </div>

          <p style="margin-top: 10px; color: #495057; font-size: 15px; font-family: 'Inter', sans-serif; line-height: 1.5;">
            {{ $feedback->comment }}
          </p>
          <div style="font-size: 12px; color: #868e96; margin-top: 8px; font-family: 'Inter', sans-serif;">
            {{ $feedback->created_at->diffForHumans() }}
          </div>
        </div>
      </div>
    @endforeach
  @else
    <div style="text-align: center; padding: 40px; background: #F8F9FA; border-radius: 12px; font-family: 'Inter', sans-serif;">
      <p style="color: #6C757D">No reviews yet</p>
    </div>
  @endif
</div>
<x-footer />

  <style>
    .rating-badge {
      left: 577.5px;
      top: 144px;
      position: absolute;
      display: flex;
      align-items: center;
      gap: 5px;
      color: black;
      background: #DBFFDE;
      border-radius: 28.13px;
      padding: 6px 12px;
      font-size: 16px;
      font-weight: 600;
      font-family: Inter, sans-serif;
    }

    .rating-icon {
        width: 16px;
        height: 16px;
        fill: var(--black);
        filter: drop-shadow(0 1px 1px rgba(0, 0, 0, 0.1));
    }
    .rating-badge:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
}

  </style>

<script src="{{ asset('js/jquery-3.5.1.min.dc5e7f18c8.js') }}?site=6706104d4f29e916e4cae2ad" type="text/javascript"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/mainScript.js') }}" type="text/javascript"></script>
