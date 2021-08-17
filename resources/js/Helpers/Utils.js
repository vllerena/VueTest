export function isUndefinedOrNull(p) {
    if(_.isNumber(p))
        return false;
    return _.isUndefined(p) || _.isEmpty(p) || _.isNull(p);
}

export function convertResponseToJson(res) {
    return JSON.parse(res)
}
