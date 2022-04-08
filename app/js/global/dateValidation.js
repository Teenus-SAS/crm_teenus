validationDate = (date) => {

    let f1 = new Date()
    let f2 = new Date(date)
    dias = 1
    f2.setDate(f2.getDate() + dias);

    if (f1 >= f2)
        return 0
    else
        return 1
}