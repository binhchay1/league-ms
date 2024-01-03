
<article id="branch">
    <section>
        <div>Player 1</div>
        <div>Player 2</div>
        <div>Player 3</div>
        <div>Player 4</div>
        <div>Player 5</div>
        <div>Player 6</div>
        <div>Player 7</div>
        <div>Player 8</div>
        <div>Player 8</div>
        <div>Player 8</div>
        <div>Player 8</div>
        <div>Player 8</div>
        <div>Player 8</div>
        <div>Player 8</div>
        <div>Player 8</div>
        <div>Player 8</div>
        <div>Player 8</div>
    </section>

    <div class="connecter">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div class="line">
        <div>
        </div><div>
        </div><div>
        </div><div>
        </div>
    </div>

    <section id="quarterFinals">
        <div>1</div>
        <div>2</div>
        <div>3</div>
        <div>4</div>
        <div>4</div>
        <div>4</div>
        <div>4</div>
        <div>4</div>
    </section>

    <div class="connecter" id="conn2">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div class="line" id="line2">
        <div></div>
        <div></div>
    </div>

    <section id="semiFinals">
        <div>5</div>
        <div>6</div>
    </section>

    <div class="connecter" id="conn3">
        <div></div>
    </div>

    <div class="line" id="line3">
        <div></div>
    </div>

    <section id="final">
        <div>7</div>
    </section>

</article>


<style>
    #branch {
        width: 1000px;
        float: left;
    }

    section {
        height: 520px;
        float: left;
    }

    section > div {
        width: 200px;
        height: 40px;
        border: 1px solid #000;
        margin: 10px 0;
        background: #73789F;
        color: white;
        padding: 10px 10px 10px 20px;
    }

    section > div:nth-child(2n) {
        margin-bottom: 40px;
    }

    .connecter {
        width: 30px;
        height: 520px;
        float: left;
    }

    .line {
        width: 30px;
        height: 520px;
        float: left;
    }

    .connecter div {
        border: 1px solid #000;
        border-left: none;
        height: 50px;
        width: 100%;
        margin: 80px 0 0 1px;
    }

    .connecter div:first-child {
        margin: 32px 0 0 1px;
    }

    .line div {
        border-top: 1px solid #000;
        margin: 133px 0 0 1px;
    }

    .line div:first-child {
        margin-top: 55px;
    }

    #quarterFinals > div {
        margin-top: 91px;
    }

    #quarterFinals > div:first-child {
        margin-top: 37px;
    }

    #conn2 div {
        margin-top: 133px;
        height: 133px;
    }

    #conn2 div:first-child {
        margin-top: 57px;
    }

    #line2 div {
        margin-top: 270px;
    }

    #line2 div:first-child {
        margin-top: 125px;
    }
    #semiFinals > div {
        margin-top: 230px;
    }
    #semiFinals > div:first-child {
        margin-top: 105px;
    }
    #conn3 div {
        margin-top: 125px;
        height: 270px;
    }

    #line3 div {
        margin-top: 270px;
    }

    #final > div {
        margin-top: 250px;
    }

</style>
