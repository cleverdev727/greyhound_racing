function CFiche(iX,iY,iIndex,szValue,bClickable,oParentContainer){
    var _bDisable;
    var _iWidth;
    var _iHeight;
    var _aCbCompleted;
    var _aCbOwner;
    var _aParams;
    
    var _oSprite;
    var _oTextValue;
    var _oContainer;
    var _oParentContainer = oParentContainer;
    
    this._init = function(iX,iY,iIndex,szValue,bClickable){
        _oContainer = new createjs.Container();
        _oContainer.x = iX;
        _oContainer.y = iY;
        _oParentContainer.addChild(_oContainer);
        
        var oSpriteFiche = s_oSpriteLibrary.getSprite('fiche_'+iIndex);
        _oSprite = createBitmap(oSpriteFiche);
        _oContainer.addChild(_oSprite);
        
        
        _oTextValue = new CTLText(_oContainer, 
                    8, 8, oSpriteFiche.width-21, 20, 
                    20, "center",  COLOR_FICHE_PER_VALUE[iIndex], PRIMARY_FONT, 1,
                    0, 0,
                    szValue,
                    true, true, false,
                    true );
                    
       
        
        if(bClickable){
            _bDisable = false;
            _iWidth = oSpriteFiche.width;
            _iHeight = oSpriteFiche.height;
        
            _aCbCompleted=new Array();
            _aCbOwner =new Array();
            
            _oContainer.on("mousedown", this.buttonDown);
            _oContainer.on("pressup" , this.buttonRelease);      
        }
        
        _oContainer.regX = oSpriteFiche.width/2;
        _oContainer.regY = oSpriteFiche.height/2;
    };
    
    this.addEventListener = function( iEvent,cbCompleted, cbOwner ){
        _aCbCompleted[iEvent]=cbCompleted;
        _aCbOwner[iEvent] = cbOwner; 
    };
    
    this.addEventListenerWithParams = function(iEvent,cbCompleted, cbOwner,aParams){
        _aCbCompleted[iEvent]=cbCompleted;
        _aCbOwner[iEvent] = cbOwner;
        _aParams = aParams;
    };
    
    this.enable = function(){
        _bDisable = false;
        
        _oContainer.filters = [];

        _oContainer.cache(0,0,_iWidth,_iHeight);
    };
    
    this.disable = function(){
        _bDisable = true;
        
        var matrix = new createjs.ColorMatrix().adjustSaturation(-100).adjustBrightness(40);
        _oContainer.filters = [
                 new createjs.ColorMatrixFilter(matrix)
        ];
        _oContainer.cache(0,0,_iWidth,_iHeight);
    };
    
    this.setScale = function(iScale){
        _oContainer.scaleX = _oContainer.scaleY = iScale;
    };
    
    this.buttonRelease = function(){
        if(_bDisable){
            return;
        }
        
        
        playSound("click", 1, false);
        
        
        _oContainer.scaleX = 1;
        _oContainer.scaleY = 1;

        if(_aCbCompleted[ON_MOUSE_UP]){
            _aCbCompleted[ON_MOUSE_UP].call(_aCbOwner[ON_MOUSE_UP],_aParams);
        }
    };
    
    this.buttonDown = function(){
        if(_bDisable){
            return;
        }
        _oContainer.scaleX = 0.9;
        _oContainer.scaleY = 0.9;

       if(_aCbCompleted[ON_MOUSE_DOWN]){
           _aCbCompleted[ON_MOUSE_DOWN].call(_aCbOwner[ON_MOUSE_DOWN],_aParams);
       }
    };
    
    this._init(iX,iY,iIndex,szValue,bClickable);
}