<x-decoratorheader />
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="wg-box">
                <div class="flex items-center justify-between">
                    <h5>Create New Package</h5>
                    <div class="dropdown default">
                        <a href="{{ route('decorator.packages') }}" class="btn btn-secondary">
                            <span class="view-all">Back to Packages</span>
                        </a>
                    </div>
                </div>
                
                <div class="form-wrapper">
                    <form method="POST" action="{{ route('decorator.packages.store') }}" class="form-box">
                        @csrf
                        
                        <div class="form-group">
                            <label for="title">Package Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Price (₹)</label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                            @error('price')
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Include Events in Package</label>
                            <div class="event-selection-container">
                                @if($events->isEmpty())
                                    <p class="text-muted">No events available. Please create some events first.</p>
                                @else
                                    @foreach($events as $event)
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="event-{{ $event->event_id }}" name="events[]" value="{{ $event->event_id }}" 
                                                {{ (is_array(old('events')) && in_array($event->event_id, old('events'))) ? 'checked' : '' }}>
                                            <label for="event-{{ $event->event_id }}">
                                                {{ $event->title }} (₹{{ number_format($event->price, 2) }})
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            @error('events')
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Create Package</button>
                            <a href="{{ route('decorator.packages') }}" class="btn btn-outline-secondary ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<x-decoratorfooter />
