pais(pam,bob).
pais(tom,bob).
pais(tom,liz).
pais(bob,ann).
pais(bob,pat).
pais(pat,jim).
amiga(X):-(X = maria; X = joana).
avos(X,Z):-pais(X,Y), pais(Y,Z).
filho(Y,X):-pais(X,Y).
mulher(pam).
mulher(liz).
mulher(ann).
mulher(pat).
mae(X,Y):-pais(X,Y), mulher(X).
irma(X,Y):-pais(Z,X),pais(Z,Y),mulher(X),(X)==(Y).
tia(X,Y):-pais(Z,Y),irma(X,Z).
predecessor(X,Z):-pais(X,Z).
predecessor(X,Z):-pais(X,Y),predecessor(Y,Z).