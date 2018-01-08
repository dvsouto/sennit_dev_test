<h2><i class="fa fa-cog" aria-hidden="true"></i> API Rest</h2>

<div class="token-div">
    <label for="seu_token"><i class="fa fa-key" aria-hidden="true"></i> Seu token</label>
    <input type="text" class="form-control" id="seu_token" name="seu_token" value="{{ session()->get('token') }}" readonly />
</div>

<iframe id="api-doc-iframe" src="/api-doc" frameborder="0"></iframe>