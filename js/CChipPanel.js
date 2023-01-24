function CChipPanel(iX,iY,oParentContainer){
    
    var _aChipButtons;
    
    var _oChipHighlight;
    var _oTextMoney;
    var _oTextMinBet;
    var _oTextMaxBet;
    var _oTextBet;
    var _oButStartRace;
    var _oClearBet;
    var _oContainer;
    var _oParentContainer;
    
    
    this._init = function(iX,iY){
        _oContainer = new createjs.Container();
        _oContainer.x = iX;
        _oContainer.y = iY;
        _oParentContainer.addChild(_oContainer);
        
        
        _oClearBet = new CTextButton(73,2,s_oSpriteLibrary.getSprite("but_clear_bet"), TEXT_CLEAR_BET, PRIMARY_FONT, "#fff", 24,_oContainer);
        _oClearBet.addEventListener(ON_MOUSE_UP,this._onClearBet,this);
        
        var oSprite = s_oSpriteLibrary.getSprite("money_panel");
        var oMinMaxBet = createBitmap(s_oSpriteLibrary.getSprite("money_panel"));
        oMinMaxBet.regX = oSprite.width/2;
        oMinMaxBet.x = 73;
        oMinMaxBet.y = 22;
        _oContainer.addChild(oMinMaxBet);
        
        _oTextMinBet = new CTLText(_oContainer, 
                    18, 30, 110, 14, 
                    14, "center", "#ffde00", SECONDARY_FONT, 1,
                    0, 0,
                    TEXT_MIN_BET + ": " + MIN_BET + TEXT_CURRENCY,
                    true, true, false,
                    false );

        
        _oTextMaxBet = new CTLText(_oContainer, 
                    18, 44, 110, 14, 
                    14, "center", "#ffde00", SECONDARY_FONT, 1,
                    0, 0,
                    TEXT_MAX_BET + ": " + MAX_BET + TEXT_CURRENCY,
                    true, true, false,
                    false );
                    

        
        var oMoneyBg = createBitmap(s_oSpriteLibrary.getSprite("money_panel"));
        oMoneyBg.regX = oSprite.width/2;
        oMoneyBg.x = 73;
        oMoneyBg.y = 72;
        _oContainer.addChild(oMoneyBg);
        
        var oText = new CTLText(_oContainer, 
                    3, 75, 100, 11, 
                    11, "left", "#fff", TERTIARY_FONT, 1,
                    0, 0,
                    TEXT_BET,
                    true, true, false,
                    false );
                    

        
        _oTextBet = new CTLText(_oContainer, 
                    18, 82, 110, 26, 
                    26, "center", "#ffde00", SECONDARY_FONT, 1,
                    0, 0,
                    "0"+TEXT_CURRENCY,
                    true, true, false,
                    false );

        
        var oMoneyBg = createBitmap(oSprite);
        oMoneyBg.regX = oSprite.width/2;
        oMoneyBg.x = 73;
        oMoneyBg.y = 122;
        _oContainer.addChild(oMoneyBg);
        
        var oText = new CTLText(_oContainer, 
                    3, 125, 100, 11, 
                    11, "left", "#fff", TERTIARY_FONT, 1,
                    0, 0,
                    TEXT_MONEY,
                    true, true, false,
                    false );
                    

        
        _oTextMoney = new CTLText(_oContainer, 
                    18, 132, 110, 26, 
                    26, "center", "#ffde00", SECONDARY_FONT, 1,
                    0, 0,
                    s_iCurMoney+TEXT_CURRENCY,
                    true, true, false,
                    false );
                    

        
        this._initChips();
        
        _oButStartRace = new CButStartRace(73,304,s_oSpriteLibrary.getSprite("but_start_race"), TEXT_START_RACE, "#fff", 24,_oContainer);
        _oButStartRace.addEventListener(ON_MOUSE_UP,this._onStartRace,this);
        
    };
    
    this.unload = function(){
         for(var i=0;i<_aChipButtons;i++){
             _aChipButtons[i].unload();
         }
         
         _oButStartRace.unload();
    };
    
    this._initChips = function(){
        var oBg = createBitmap(s_oSpriteLibrary.getSprite("fiche_panel"));
        oBg.x = 0;
        oBg.y = 170;
        _oContainer.addChild(oBg);
        
        //SET FICHES BUTTON
        var aPos = [{x:25,y:198},{x:76,y:198},{x:124,y:198},{x:25,y:242},{x:76,y:242},{x:124,y:242}];
        _aChipButtons = new Array();

        for(var i=0;i<NUM_CHIPS;i++){
            _aChipButtons[i] = new CFicheBut(i,aPos[i].x,aPos[i].y,1,_oContainer);
            _aChipButtons[i].addEventListenerWithParams(ON_MOUSE_UP, this._onFicheClicked, this,i);
        }
        
        //SET SELECTED CHIP
        var oSpriteHighlight = s_oSpriteLibrary.getSprite('fiche_highlight');
        _oChipHighlight = createBitmap(oSpriteHighlight);
        _oChipHighlight.regX = oSpriteHighlight.width/2;
        _oChipHighlight.regY = oSpriteHighlight.height/2;
        _oChipHighlight.x = _aChipButtons[0].getX()-1;
        _oChipHighlight.y = _aChipButtons[0].getY()-1;
        _oContainer.addChild(_oChipHighlight);
    };
    
    this.refreshMoney = function(){
        _oTextMoney.refreshText(s_iCurMoney+TEXT_CURRENCY);
    };
    
    this.refreshBet = function(iBet){
        _oTextBet.refreshText(iBet+TEXT_CURRENCY);
    };
    
    this._onStartRace = function(){
        s_oBetPanel.onStartExit();
    };
    
    this._onClearBet = function(){
        s_oBetPanel.clearBet();
    };
    
    this._onFicheClicked = function(iIndex){
        _oChipHighlight.x = _aChipButtons[iIndex].getX()-1;
        _oChipHighlight.y = _aChipButtons[iIndex].getY()-1;
        
        s_oBetPanel.setChipSelected(iIndex);
    };
    
    _oParentContainer = oParentContainer;
    this._init(iX,iY);
}