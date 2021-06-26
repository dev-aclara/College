pais(maria,jose).
pais(joao,jose).
pais(joao,ana).
pais(jose,julia).
pais(jose,iris).
pais(iris,jorge).
amiga(X):-(X=maria;X=joana).
avos(X,Z):-pais(X,Y),pais(Y,Z).
filho(Y,X):-pais(X,Y).
mulher(maria).
mulher(julia).
mulher(iris).
mulher(ana).
mae(X,Y):-pais(X,Y),mulher(X).
irma(X,Y):-pais(Z,X),pais(Z,Y),mulher(X),(X)\==(Y).
tia(X,Y):-pais(Z,Y),irma(X,Z).
progenitor(X,Z):-pais(X,Z). %regra para os pais
progenitor(X,Z):-pais(X,Y),progenitor(Y,Z).  %regra pra os avos