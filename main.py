#coding:utf-8
import tkinter

#add_checkbutton()
#add_radiobutton()
#add_separator()

def show_about():
    about_window =  tkinter.Toplevel(app)
    about_window.title("à propos")
    lb= tkinter.Label(about_window, text="Ok voici un app que j'ai créé en Python, il s'agit d'un création de menu!")
    lb.pack()

#creation de la fenetre et parametrage
app = tkinter.Tk()
app.geometry("640x480")
app.title("création du menu")

#widgets...
mainmenu = tkinter.Menu(app)

first_menu = tkinter.Menu(mainmenu, tearoff=0)
first_menu.add_command(label="option1")
first_menu.add_command(label="option2")
first_menu.add_command(label="option3")
first_menu.add_separator()
first_menu.add_command(label="Quitter", command=app.quit)

second_menu = tkinter.Menu(mainmenu, tearoff=0)
second_menu.add_command(label="commande1")
second_menu.add_checkbutton(label="à propos", command=show_about)

mainmenu.add_cascade(label="Premier", menu=first_menu)
mainmenu.add_cascade(label="second", menu=second_menu)

#Boucle principale
app.config(menu=mainmenu)
app.mainloop()

