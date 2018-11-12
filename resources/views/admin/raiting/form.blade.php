<div id="ops-note" class="container ops-main">

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">総合評価入力</h3>
        </div>
    </div>

    @include('admin/message')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">

            @if($target == 'store')
            <form action="/admin/raitings" method="post">
            @else
            <form action="/admin/raitings/{{$raiting->id}}" method="post">
                <input type="hidden" name="_method" value="PATCH">
            @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="participant_id" value="{{ $raiting->participant_id}}">
                <div class="form-group">
                    <label for="skill_a">タイトル</label>
                    <input type="text" name="title" class="form-control" id="title"
                      value="{{ old('title') != null ? old('title') : $raiting->title }}">
                </div>

                <div class="form-group">
                    <label for="skill_a">プログラミング</label>
                    <select class="form-control" style="width:120px" name="skill_a" id="skill_a">
                        <option></option>
                        <option {{ (old('skill_a') != null ? old('skill_a') : $raiting->skill_a) == 4 ? "selected" : ""}}>4</option>
                        <option {{ (old('skill_a') != null ? old('skill_a') : $raiting->skill_a) == 3 ? "selected" : ""}}>3</option>
                        <option {{ (old('skill_a') != null ? old('skill_a') : $raiting->skill_a) == 2 ? "selected" : ""}}>2</option>
                        <option {{ (old('skill_a') != null ? old('skill_a') : $raiting->skill_a) == 1 ? "selected" : ""}}>1</option>
                    </select>
                    <label for="skill_a_comment">コメント</label>
                    <textarea class="form-control"
                            id="skill_a_comment"
                            name="skill_a_comment"
                            placeholder="コメント" style="height:160px">{{ old('skill_a_comment') != null ? old('skill_a_comment') : $raiting->skill_a_comment }}</textarea>
                </div>
                <div class="form-group">
                    <label for="skill_b">Web</label>
                    <select class="form-control" style="width:120px" name="skill_b" id="skill_b">
                        <option></option>
                        <option {{ (old('skill_b') != null ? old('skill_b') : $raiting->skill_b) == 4 ? "selected" : ""}}>4</option>
                        <option {{ (old('skill_b') != null ? old('skill_b') : $raiting->skill_b) == 3 ? "selected" : ""}}>3</option>
                        <option {{ (old('skill_b') != null ? old('skill_b') : $raiting->skill_b) == 2 ? "selected" : ""}}>2</option>
                        <option {{ (old('skill_b') != null ? old('skill_b') : $raiting->skill_b) == 1 ? "selected" : ""}}>1</option>
                    </select>
                    <label for="skill_b_comment">コメント</label>
                    <textarea class="form-control"
                            id="skill_b_comment"
                            name="skill_b_comment"
                            placeholder="コメント" style="height:160px">{{ old('skill_b_comment') != null ? old('skill_b_comment') : $raiting->skill_b_comment }}</textarea>
                </div>
                <div class="form-group">
                    <label for="skill_c">DB</label>
                    <select class="form-control" style="width:120px" name="skill_c" id="skill_c">
                        <option></option>
                        <option {{ (old('skill_c') != null ? old('skill_c') : $raiting->skill_c) == 4 ? "selected" : ""}}>4</option>
                        <option {{ (old('skill_c') != null ? old('skill_c') : $raiting->skill_c) == 3 ? "selected" : ""}}>3</option>
                        <option {{ (old('skill_c') != null ? old('skill_c') : $raiting->skill_c) == 2 ? "selected" : ""}}>2</option>
                        <option {{ (old('skill_c') != null ? old('skill_c') : $raiting->skill_c) == 1 ? "selected" : ""}}>1</option>
                    </select>
                    <label for="skill_c_comment">コメント</label>
                    <textarea class="form-control"
                            id="skill_c_comment"
                            name="skill_c_comment"
                            placeholder="コメント" style="height:160px">{{ old('skill_c_comment') != null ? old('skill_c_comment') : $raiting->skill_c_comment }}</textarea>
                </div>
                <div class="form-group">
                    <label for="skill_d">積極性</label>
                    <select class="form-control" style="width:120px" name="skill_d" id="skill_d">
                        <option></option>
                        <option {{ (old('skill_d') != null ? old('skill_d') : $raiting->skill_d) == 4 ? "selected" : ""}}>4</option>
                        <option {{ (old('skill_d') != null ? old('skill_d') : $raiting->skill_d) == 3 ? "selected" : ""}}>3</option>
                        <option {{ (old('skill_d') != null ? old('skill_d') : $raiting->skill_d) == 2 ? "selected" : ""}}>2</option>
                        <option {{ (old('skill_d') != null ? old('skill_d') : $raiting->skill_d) == 1 ? "selected" : ""}}>1</option>
                    </select>
                    <label for="skill_d_comment">コメント</label>
                    <textarea class="form-control"
                            id="skill_d_comment"
                            name="skill_d_comment"
                            placeholder="コメント" style="height:160px">{{ old('skill_d_comment') != null ? old('skill_d_comment') : $raiting->skill_d_comment }}</textarea>
                </div>
                <div class="form-group">
                    <label for="skill_e">徹底性</label>
                    <select class="form-control" style="width:120px" name="skill_e" id="skill_e">
                        <option></option>
                        <option {{ (old('skill_e') != null ? old('skill_e') : $raiting->skill_e) == 4 ? "selected" : ""}}>4</option>
                        <option {{ (old('skill_e') != null ? old('skill_e') : $raiting->skill_e) == 3 ? "selected" : ""}}>3</option>
                        <option {{ (old('skill_e') != null ? old('skill_e') : $raiting->skill_e) == 2 ? "selected" : ""}}>2</option>
                        <option {{ (old('skill_e') != null ? old('skill_e') : $raiting->skill_e) == 1 ? "selected" : ""}}>1</option>
                    </select>
                    <label for="skill_e_comment">コメント</label>
                    <textarea class="form-control"
                            id="skill_e_comment"
                            name="skill_e_comment"
                            placeholder="コメント" style="height:160px">{{ old('skill_e_comment') != null ? old('skill_e_comment') : $raiting->skill_e_comment }}</textarea>
                </div>
                <div class="form-group">
                    <label for="skill_f">誠実さ</label>
                    <select class="form-control" style="width:120px" name="skill_f" id="skill_f">
                        <option></option>
                        <option {{ (old('skill_f') != null ? old('skill_f') : $raiting->skill_f) == 4 ? "selected" : ""}}>4</option>
                        <option {{ (old('skill_f') != null ? old('skill_f') : $raiting->skill_f) == 3 ? "selected" : ""}}>3</option>
                        <option {{ (old('skill_f') != null ? old('skill_f') : $raiting->skill_f) == 2 ? "selected" : ""}}>2</option>
                        <option {{ (old('skill_f') != null ? old('skill_f') : $raiting->skill_f) == 1 ? "selected" : ""}}>1</option>
                    </select>
                    <label for="skill_f_comment">コメント</label>
                    <textarea class="form-control"
                            id="skill_f_comment"
                            name="skill_f_comment"
                            placeholder="コメント" style="height:160px">{{ old('skill_f_comment') != null ? old('skill_f_comment') : $raiting->skill_f_comment }}</textarea>
                </div>
                <div class="form-group">
                    <label for="comment">総合コメント</label>
                    <textarea class="form-control"
                            id="comment"
                            name="comment"
                            placeholder="コメント" style="height:160px">{{ old('comment') != null ? old('comment') : $raiting->comment }}</textarea>
                </div>
                <button type="submit" class="btn btn-default">保存</button>
            </form>
        </div>
    </div>
</div>
