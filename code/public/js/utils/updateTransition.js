function updateTransition(callback){
    if(!document.startViewTransition){
        callback();
        return
    }

    document.startViewTransition(() => callback());
}