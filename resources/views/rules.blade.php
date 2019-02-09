@extends('layouts.app')

@section('content')
<div class="container">
<h2>Rules</h2>
<div class="card">
<div class="card-body">
<div class="row">
The Capitalist  are gonna rewarded with exciting cash price. So let's get to the rules which are needed to be followed by everyone to emerge as a capitalist.
</div>
<div class="row">
The game consists of 4 days. Each day consisting of a session of 15 minutes each  full of pure money making  followed by a break of 5 mins.
Between these breaks you can plan your strategy.you can scan your team profile from your mobile devices and also can enquire about the team profile from the counters only in break.
</div>
<br/>
<div class="row">
Following are the companies you can invest for:
    Accenture  Tesla  Nvidia    Alibaba Tencent Microsoft IBM HDFC Jio Bajaj Finance
    Following are the forex exchange options: USD EUR GBP DINAR CAD

Every team is allotted 10 lakh of balance at the beginning of the game.
Later on, when a team buys x number of shares from a certain company worth Rs. Y, x*Y amount is deducted from that team’s account. And when a certain amount of shares is sold the amount is added to the existing     balance.

</div>

<br/>
<div class="row">
Each transaction made is levied with 2% brokerage fees. Depending on the amount of shares sold or bought the rate of the company alters.

Now we move onto NEWS. At the start of a session news will be displayed. The news would consist of the current market trend and the company’s highs and lows. (Read them out as and when they are displayed). At the end of each session stock prices will be displayed.
Let’s now probe into the concept of Dividend. When any company makes profit it divides its profit equally amongst all its shareholders.
Say, for example, for every 100 shares an investor holds of company A, it is decided that Rs.12 is to be given to each of its investors then the final balance of the investors will include the earlier balance + the dividend     provided i.e. rs.12.

</div>

<br/>
<div class="row">
The concept of BONUS is similar to that of the dividend. In this, the no. of shares is added to the investors balance. Say , for example, the company decides 5 % balance so if  a team has 100 shares of company A then he gets 5 more shares and thus increasing the balance by 5* amount of each share.
Now, to the most interesting point of the dalal world -  Short Sell and Buy Back

</div>

<br/>
<div class="row">
Consider that there is a company you feel is going to go down on its rates, i.e., you assume that its rates will be dropped. So you can sell a certain amount of its shares before buying them.
For example, the current rate of each share is Rs. 100 and you think it’ll be down to Rs.80; so you get to sell it first at Rs.100 and you can then buy it back for Rs.80 thus leading to a profit of 20 bucks.
    The transaction will take place at an exclusive short sell counter.
Initially the selling price i.e. Rs. 100 would not be added to your balance; only after you buy it back at     whatever rate it is, will the amount be added or deducted.
Say, if you buy it back at Rs.80 and then your profit of Rs.20 will be added. But if you buy it back for more than its selling price say at Rs.130, then Rs.30 would be deducted from your balance.
If there’s a loss during buy back and the team does not have enough balance then only 10 % of their balance will be deducted.
</div>

<br/>
<div class="row">
The duration of a short sell to be executed is only 1 day. i.e., before the end of day 1 i.e. 2 sessions the shares sold have to be bought back (Explain sell in 1st session and 2nd session). 
If you don’t buy back till the end of day 1 then the system will automatically buy back the shares sold at the latest cost price and the corresponding profit/loss amount would be added or deducted respectively.
    And combined to this if the team has no balance in case of a loss, 10 % of balance is deducted.
Now coming back to results, if there are assets i.e. certain shares that remain unsold then that number of shares would be automatically sold at the current rate and the final balance will be evaluated by considering the profit or loss made with the assets.
</div>

<br/>
</div>
</div>
</div>
@endsection
