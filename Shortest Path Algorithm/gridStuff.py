from tkinter import *

from heapq import heappush, heappop # for priority queue
import math
import time
import random
from time import sleep


class Cell():
    FILLED_COLOR_BG = "red"
    EMPTY_COLOR_BG = "white"
    FILLED_COLOR_BORDER = "green"
    EMPTY_COLOR_BORDER = "black"
    TARGET_COLOR = "blue"
    WALL_COLOR = "black"
    

    def __init__(self, master, x, y, size):
        """ Constructor of the object called by Cell(...) """
        self.master = master
        self.abs = x
        self.ord = y
        self.size= size
        self.fill= False
        

    def _switch(self):
        """ Switch if the cell is filled or not. """
        self.fill= not self.fill

    def refill(self, color):
        xmin = self.abs * self.size
        xmax = xmin + self.size
        ymin = self.ord * self.size
        ymax = ymin + self.size
        self.master.create_rectangle(xmin, ymin, xmax, ymax, fill = color, outline = "black")

    def draw(self):
        """ order to the cell to draw its representation on the canvas """
        if self.master != None :
            fill = Cell.FILLED_COLOR_BG
            outline = Cell.FILLED_COLOR_BORDER

            if not self.fill:
                fill = Cell.EMPTY_COLOR_BG
                outline = Cell.EMPTY_COLOR_BORDER


            xmin = self.abs * self.size
            xmax = xmin + self.size
            ymin = self.ord * self.size
            ymax = ymin + self.size

            self.master.create_rectangle(xmin, ymin, xmax, ymax, fill = fill, outline = outline)

    def draw2(self):
        """ order to the cell to draw its representation on the canvas """
        if self.master != None :
            fill = Cell.TARGET_COLOR
            outline = Cell.FILLED_COLOR_BORDER

            if not self.fill:
                fill = Cell.EMPTY_COLOR_BG
                outline = Cell.EMPTY_COLOR_BORDER

            xmin = self.abs * self.size
            xmax = xmin + self.size
            ymin = self.ord * self.size
            ymax = ymin + self.size

            self.master.create_rectangle(xmin, ymin, xmax, ymax, fill = fill, outline = outline)

    def draw3(self):
        """ order to the cell to draw its representation on the canvas """
        if self.master != None :
            fill = Cell.WALL_COLOR
            outline = Cell.FILLED_COLOR_BORDER

            if not self.fill:
                fill = Cell.EMPTY_COLOR_BG
                outline = Cell.EMPTY_COLOR_BORDER

            xmin = self.abs * self.size
            xmax = xmin + self.size
            ymin = self.ord * self.size
            ymax = ymin + self.size

            self.master.create_rectangle(xmin, ymin, xmax, ymax, fill = fill, outline = outline)

    def draw4(self):
        """ order to the cell to draw its representation on the canvas """
        if self.master != None :
            fill = "pink"
            outline = Cell.FILLED_COLOR_BORDER

            if not self.fill:
                fill = Cell.EMPTY_COLOR_BG
                outline = Cell.EMPTY_COLOR_BORDER


            xmin = self.abs * self.size
            xmax = xmin + self.size
            ymin = self.ord * self.size
            ymax = ymin + self.size

            self.master.create_rectangle(xmin, ymin, xmax, ymax, fill = fill, outline = outline)
    def drawS(self):
        """ order to the cell to draw its representation on the canvas """
        if self.master != None :
            fill = "yellow"
            outline = Cell.FILLED_COLOR_BORDER

            if not self.fill:
                fill = Cell.EMPTY_COLOR_BG
                outline = Cell.EMPTY_COLOR_BORDER


            xmin = self.abs * self.size
            xmax = xmin + self.size
            ymin = self.ord * self.size
            ymax = ymin + self.size

            self.master.create_rectangle(xmin, ymin, xmax, ymax, fill = fill, outline = outline)

class CellGrid(Canvas):
    def __init__(self,master, rowNumber, columnNumber, cellSize,pMap = 0, sx =0, sy = 0, fx = 0,fy = 0,ff = 0,*args, **kwargs):
        Canvas.__init__(self, master, width = cellSize * columnNumber , height = cellSize * rowNumber, *args, **kwargs)
        self.sx,self.sy,self.fx,self.fy = sx,sy,fx,fy
        self.cellSize = cellSize
        self.rowNumber = rowNumber
        self.columnNumber = columnNumber
        self.ff = ff
        self.pMap = [[0 for c in range(columnNumber)] for r in range(rowNumber)]
        self.grid = []
        
        for row in range(rowNumber):

            line = []
            for column in range(columnNumber):
                line.append(Cell(self, column, row, cellSize))

            self.grid.append(line)

        #memorize the cells that have been modified to avoid many switching of state during mouse motion.
        self.switched = []
        
        

        
        #self.bind("<Button-2>", self.displayMap)
        
        #bind click action
        self.bind("<Button-1>", self.handleMouseClick)  
        self.bind("<Button-3>", self.handleMouseClick2)
        self.bind('<space>', self.findFF)
        self.bind('<Return>', self.rescueStart)
        #walls
        self.bind("<Shift-1>", self.handleMouseClick3)
        self.bind("<Shift-3>", self.handleMouseClickS)
        #bind moving while clicking
        self.bind("<B1-Motion>", self.handleMouseMotion)
        #bind release button action - clear the memory of midified cells.
        self.bind("<ButtonRelease-1>", lambda event: self.switched.clear())
        

        self.draw()

    def displayMap(self, event):
        print("Map")
        for i in range(len(self.pMap)):
            print(self.pMap[i])
        
    def draw(self):
        for row in self.grid:
            for cell in row:
                cell.draw()

    def _eventCoords(self, event):
        row = int(event.y / self.cellSize)
        column = int(event.x / self.cellSize)
        return row, column

    def handleMouseClick(self, event):
        row, column = self._eventCoords(event)
        cell = self.grid[row][column]
        if self.pMap[row][column]== 1:
            self.pMap[row][column] = 0
        else:
            self.pMap[row][column] = 1
        cell._switch()
        cell.draw()
        #add the cell to the list of cell switched during the click
        self.switched.append(cell)

    def handleMouseClick2(self, event):
        row, column = self._eventCoords(event)
        cell = self.grid[row][column]
        if self.pMap[row][column]== 4:
            self.pMap[row][column] = 0
        else:
            self.pMap[row][column] = 4
        cell._switch()
        self.fx = column
        self.fy = row
        cell.draw2()
        #add the cell to the list of cell switched during the click
        self.switched.append(cell)

    def newFire(self,x,y):
        cell = self.grid[y][x]
        self.pMap[y][x] = 1
        cell._switch()
        cell.draw()
        #add the cell to the list of cell switched during the click
        self.switched.append(cell)

    def HighFire(self,x,y):
        cell = self.grid[y][x]
        self.pMap[y][x] = 1
        
        cell.draw()
        cell._switch()
        cell.refill("#FFA07A")
        #add the cell to the list of cell switched during the click
        self.switched.append(cell)

    def newWall(self, x,y):
        cell = self.grid[y][x]
        self.pMap[y][x] = 6
        cell._switch()
        cell.draw3()
        #add the cell to the list of cell switched during the click
        self.switched.append(cell)

    def opacityLevel(self,x,y):
        cell = self.grid[y][x]
        self.pMap[y][x] = 6
        
        cell.draw3()
        cell._switch()
        cell.refill("grey")
        #add the cell to the list of cell switched during the click
        self.switched.append(cell)

    def droneHighFire(self,x,y):
        cell = self.grid[y][x]
        self.pMap[y][x] = 1
        
        cell.draw()
        cell._switch()
        cell.refill("#FFA07A")
        #add the cell to the list of cell switched during the click
        self.switched.append(cell)

    def dronenewWall(self, x,y):
        cell = self.grid[y][x]
        self.pMap[y][x] = 6
        cell._switch()
        cell.draw3()
        #add the cell to the list of cell switched during the click
        self.switched.append(cell)

    def droneopacityLevel(self,x,y):
        cell = self.grid[y][x]
        self.pMap[y][x] = 6
        
        cell.draw3()
        cell._switch()
        cell.refill("grey")
        #add the cell to the list of cell switched during the click
        self.switched.append(cell)
        
        

    def handleMouseClick3(self, event):
        row, column = self._eventCoords(event)
        cell = self.grid[row][column]
        cell._switch()
        if self.pMap[row][column]== 6:
            self.pMap[row][column] = 0
        else:
            self.pMap[row][column] = 6
        cell.draw3()
        #add the cell to the list of cell switched during the click
        self.switched.append(cell)

    def handleMouseClickS(self, event):
        row, column = self._eventCoords(event)
        cell = self.grid[row][column]
        cell._switch()
        if self.pMap[row][column]== 2:
            self.pMap[row][column] = 0
        else:
            self.pMap[row][column] = 2
        cell.drawS()
        #add the cell to the list of cell switched during the click
        self.switched.append(cell)
        self.sx = column
        self.sy = row
    
    def handleMouseMotion(self, event):
        row, column = self._eventCoords(event)
        cell = self.grid[row][column]
        
        if event.state == 256:
            if cell not in self.switched:
                cell._switch()
                cell.draw()
                self.switched.append(cell)
                if self.pMap[row][column]== 1:
                    self.pMap[row][column] = 0
                else:
                    self.pMap[row][column] = 1
        elif event.state == 257:
            if cell not in self.switched:
                cell._switch()
                cell.draw3()
                self.switched.append(cell)
                if self.pMap[row][column]== 6:
                    self.pMap[row][column] = 0
                else:
                    self.pMap[row][column] = 6
                
    
    def pathFind(self,the_map, directions, dx, dy, xStart, yStart, xFinish, yFinish):
        closed_nodes_map = [] # map of closed (tried-out) nodes
        open_nodes_map = [] # map of open (not-yet-tried) nodes
        dir_map = [] # map of directions
        m = self.rowNumber
        n = self.columnNumber
        row = [0] * n
        for i in range(m): # create 2d arrays
            closed_nodes_map.append(list(row))
            open_nodes_map.append(list(row))
            dir_map.append(list(row))

        pq = [[], []] # priority queues of open (not-yet-tried) nodes
        pqi = 0 # priority queue index
        # create the start node and push into list of open nodes
        n0 = node(xStart, yStart, 0, 0)
        n0.updatePriority(xFinish, yFinish)
        heappush(pq[pqi], n0)
        open_nodes_map[yStart][xStart] = n0.priority # mark it on the open nodes map

        # A* search
        while len(pq[pqi]) > 0:
            # get the current node w/ the highest priority
            # from the list of open nodes
            n1 = pq[pqi][0] # top node
            n0 = node(n1.xPos, n1.yPos, n1.distance, n1.priority)
            x = n0.xPos
            y = n0.yPos
            heappop(pq[pqi]) # remove the node from the open list
            open_nodes_map[y][x] = 0
            # mark it on the closed nodes map
            closed_nodes_map[y][x] = 1
            

            # quit searching when the goal state is reached
            # if n0.estimate(xFinish, yFinish) == 0:
            if x == xFinish and y == yFinish:
                # generate the path from finish to start
                # by following the directions
                path = ''
                while not (x == xStart and y == yStart):
                    j = dir_map[y][x]
                    c = str((j + directions // 2) % directions)
                    path = c + path
                    x += dx[j]
                    y += dy[j]
                return path

            # generate moves (child nodes) in all possible directions
            for i in range(directions):
                xdx = x + dx[i]
                ydy = y + dy[i]
                if not (xdx < 0 or xdx > n-1 or ydy < 0 or ydy > m - 1
                        or the_map[ydy][xdx] == 1 or closed_nodes_map[ydy][xdx] == 1 or the_map[ydy][xdx] == 6 or closed_nodes_map[ydy][xdx] == 6):
                    # generate a child node
                    m0 = node(xdx, ydy, n0.distance, n0.priority)
                    m0.nextdistance(i)
                    m0.updatePriority(xFinish, yFinish)
                    # if it is not in the open list then add into that
                    if open_nodes_map[ydy][xdx] == 0:
                        open_nodes_map[ydy][xdx] = m0.priority
                        heappush(pq[pqi], m0)
                        # mark its parent node direction
                        dir_map[ydy][xdx] = (i + directions // 2) % directions
                    elif open_nodes_map[ydy][xdx] > m0.priority:
                        # update the priority info
                        open_nodes_map[ydy][xdx] = m0.priority
                        # update the parent direction info
                        dir_map[ydy][xdx] = (i + directions // 2) % directions
                        # replace the node
                        # by emptying one pq to the other one
                        # except the node to be replaced will be ignored
                        # and the new node will be pushed in instead
                        while not (pq[pqi][0].xPos == xdx and pq[pqi][0].yPos == ydy):
                            heappush(pq[1 - pqi], pq[pqi][0])
                            heappop(pq[pqi])
                        heappop(pq[pqi]) # remove the wanted node
                        # empty the larger size pq to the smaller one
                        if len(pq[pqi]) > len(pq[1 - pqi]):
                            pqi = 1 - pqi
                        while len(pq[pqi]) > 0:
                            heappush(pq[1-pqi], pq[pqi][0])
                            heappop(pq[pqi])       
                        pqi = 1 - pqi
                        heappush(pq[pqi], m0) # add the better node instead
        return '' # no route found

    def findFF(self, event):
        time.sleep(1)
        if self.ff != 0:
            self.ff.refill("white")
        x = random.randint(0,19)
        y = random.randint(0,14)
        cell = self.grid[y][x]
            
        while cell == 1 or cell == 6:
            x = random.randint(0,19)
            y = random.randint(0,14)
        cell = self.grid[y][x]
        self.ff = cell
        self.ff._switch()
        self.ff.refill("green")
        self.switched.append(cell)
        
        
        

    def rescueStart(self,event):
        self.tempMap()
    def tempMap(self):
        directions = 8 # number of possible directions to move on the map
        if directions == 4:
            dx = [1, 0, -1, 0]
            dy = [0, 1, 0, -1]
        elif directions == 8:
            dx = [1, 1, 0, -1, -1, -1, 0, 1]
            dy = [0, 1, 1, 1, 0, -1, -1, -1]

        # map matrix
        n = 20 # horizontal size
        m = 15 # vertical size
        the_map = []
        row = [0] * n
        for i in range(m):
            the_map.append(list(row))
        the_map = self.pMap
        xA = self.sx
        yA = self.sy
        xB = self.fx
        yB = self.fy

        print ('Map Size (X,Y): ', n, m)
        print ('Start: ', xA, yA)
        print ('Finish: ', xB, yB)
        t = time.time()
        route = self.pathFind(the_map, directions, dx, dy, xA, yA, xB, yB)
        print ('Time to generate the route (s): ', time.time() - t)
        print ('Route:')
        
        print (route)

        # mark the route on the map
        if len(route) > 0:
            x = xA
            y = yA
            the_map[y][x] = 2
            for i in range(len(route)):
                j = int(route[i])
                x += dx[j]
                y += dy[j]
                the_map[y][x] = 3
            the_map[y][x] = 4

        # display the map with the route
        cell = self.grid[y][x]
        #cell._switch()

        '''
        print ('Map:')
        for y in range(m):
            for x in range(n):
                xy = the_map[y][x]
                if xy == 0:
                    print ('.', end = "") # space
                    cell.refill("white")
                elif xy == 1:
                    print ('O',end = "") # obstacle
                    cell.refill("red")
                elif xy == 2:
                    print ('S',end = "") # start
                    cell.refill("yellow")
                elif xy == 3:
                    cell.refill("pink")
                    print ('R',end = "") # route
                elif xy == 6:
                    print('W', end = "")
                    cell.refill("black")
                elif xy == 4:
                    cell.refill("blue")
                    print ('F', end = "") # finish
            print()'''
        
        for y in range(m):
            for x in range(n):
                xy = the_map[y][x]
                if xy == 2:
                    cell = self.grid[y][x]
                    cell._switch()
                    cell.refill("yellow")
                    #add the cell to the list of cell switched during the click
                    self.switched.append(cell)
                if xy == 3:
                    cell = self.grid[y][x]
                    cell._switch()
                    cell.refill("pink")
                    #add the cell to the list of cell switched during the click
                    self.switched.append(cell)
                if xy == 4:
                    cell = self.grid[y][x]
                    cell._switch()
                    cell.refill("blue")
                    #add the cell to the list of cell switched during the click
                    self.switched.append(cell)

        self.postscript(file="tkinter.ps", colormode='color')
        
                    
        
        

class node:
    # current position
    xPos = 0
    yPos = 0
    # total distance already travelled to reach the node
    distance = 0
    # priority = distance + remaining distance estimate
    priority = 0 # smaller: higher priority
    def __init__(self, xPos, yPos, distance, priority):
        self.xPos = xPos
        self.yPos = yPos
        self.distance = distance
        self.priority = priority
    def __lt__(self, other): # for priority queue
        return self.priority < other.priority
    def updatePriority(self, xDest, yDest):
        self.priority = self.distance + self.estimate(xDest, yDest) * 10 # A*
    # give better priority to going straight instead of diagonally
    def nextdistance(self, i): # i: direction
        if i % 2 == 0:
            self.distance += 10
        else:
            self.distance += 14
    
    # Estimation function for the remaining distance to the goal.
    def estimate(self, xDest, yDest):
        xd = xDest - self.xPos
        yd = yDest - self.yPos
        # Euclidian Distance
        d = math.sqrt(xd * xd + yd * yd)
        # Manhattan distance
        # d = abs(xd) + abs(yd)
        # Chebyshev distance
        # d = max(abs(xd), abs(yd))
        return(d)





    
        


if __name__ == "__main__" :
    
    app = Tk()
    grid = CellGrid(app, 15, 20, 40)

    #tcp call waiting for data here
    '''
    grid.HighFire(3,3)
    grid.newFire(1,2)
    grid.newWall(2,3)
    grid.opacityLevel(3,4)'''
    #drone
    '''grid.droneHighFire(3,3)
    grid.dronenewFire(1,2)
    grid.dronenewWall(2,3)
    grid.droneopacityLevel(3,4)'''
    grid.pack()
    
    
    

    # fillout the map matrix with a '+' pattern
    
    
    app.mainloop()
