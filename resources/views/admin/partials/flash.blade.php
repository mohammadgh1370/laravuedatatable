<flash :error="{{ json_encode(['code' => -1, 'message' => $errors->all()]) }}"
       :success="{{json_encode(Session::get('flash'))}}"></flash>
