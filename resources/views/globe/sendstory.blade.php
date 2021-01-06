<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">History</div>

                <div class="panel-body" id="historias">
                    @foreach($histories as $h)
                        <p>{{ $h->description }} - {{ $h->location->country->name }} - {{ $h->location->city->name }}</p>
                    @endforeach
                </div>

                <div class="input-group" id="chat-form">
                    <input id="description" type="text" name="message" class="form-control input-sm" placeholder="Type your message here...">
                    <input id="user_id" type="hidden" name="user" value="{{ Auth::user()->id }}">
                    <input id="history_date" type="hidden" name="user" value="2020-12-22">
                    <input id="country" type="hidden" name="user" value="Portugal">
                    <input id="city" type="hidden" name="user" value="Porto">
                    <input id="active" type="hidden" name="user" value="1">
                    <input id="emotion_id" type="hidden" name="user" value="0">

                    <span class="input-group-btn">
                          <button class="btn btn-primary btn-sm" id="btn-history">
                              Send
                          </button>
                      </span>
                </div>
            </div>
        </div>
    </div>
</div> -->
