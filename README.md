![NIST](https://nccoe.nist.gov/sites/all/themes/custom/nccoe2x/asset/img/NIST_logo.svg)
# ZENO Web App

The ZENO software tool computes material, solution, and suspension properties
for a specifed particle shape or molecular structure using path-integral and
Monte Carlo methods. These properties include: capacitance, electric
polarizability tensor, intrinsic conductivity, volume, gyration tensor,
hydrodynamic radius, intrinsic viscosity, friction coeffcient, diffusion
coeffcient, sedimentation coeffcient, and related quantities. The ZENO code is
composed of two types of calculations: exterior and interior.

## Exterior computation

The exterior calculation focuses on the computation of electrical properties
including the capacitance, the electric polarizability tensor, and the intrinsic
conductivity. Once the electrical properties are known, the hydrodynamic
properties, including the hydrodynamic radius and the intrinsic viscosity, can
be precisely estimated by invoking an electrostatic- hydrodynamic analogy. Other
related properties are also determined. To compute the aforementioned properties
for an object requires the solution of Laplace's equation outside the object
with appropriate boundary conditions. This is effciently accomplished by using
a Monte Carlo method, which involves:
* Creating a launch sphere that encloses the object.
* Launching random walks from the surface of the launch sphere.
* Determining the fate of such walks: if they hit the object or go to infinity.

These walks are exterior to the object, hence the name for the
calculation. Each random walk is generated using a method called Walk on
Spheres. This algorithm requires generating a sphere for each step in the random
walk. The center of this sphere is located at the end of the current random
walk; the radius of the sphere is determined by finding the shortest distance
between the center of the sphere and the object. Finally, the step in the walk
is taken by randomly choosing a point on the surface of the sphere. The process
is then repeated. Since the size of spheres will progressively get smaller as
the object is approached, a cutoff distance, known as the skin thickness, is
required. Without a cutoff distance, the algorithm would continue, at least
theoretically, indefinitely. As this is reminiscent of Zeno's paradox of
Tortoise and Achilles, the code is named in Zeno's honor.

## Interior computation

The interior calculation determines the volume and the gyration tensor for an
object using a Monte Carlo method. Specifically, this calculation involves
generating random points within the same launch sphere as in the exterior
calculation. The location of these points can then be used to approximate all of
the relevant properties. For example, the volume of the object is estimated by
the fraction of points inside the object multiplied by the the volume of the
launch sphere. The interior calculation is given its name since the points in
the interior of the object are essential for computing the properties.


## Configuration
#### Input file


The "Definition of object file: " field must contain a list of spheres that
define the shape of the object.  It should contain lines of

SPHERE x y z r

where x, y, and z are the x, y, and z positions of the center of the sphere, and
r is the radius. It can be field manually or by uploading a bod file.


#### Exterior calculation

Either the number of exterior walks, the maximum relative standard deviation of
the capacitance, or the maximum relative standard deviation of the mean electric
polarizability must be specified. If one of the relative standard deviations are
specified, then the calculation will continue performing walks until the
relative standard deviation is less than the specified value. One of the
following options is required for running the exterior calculation.

#### Interior calculation

Either the number of interior samples or the maximum relative standard deviation
of the volume must be specified. If the relative standard deviation is
specified, then the calculation will continue performing walks until the
relative standard deviation is less than the specified value.   

#### Optional inputs
##### Launch radius

the Launch radius is the radius of the sphere from which random walks are
launched. The radius must be large enough to enclose the entire object.  Default
value:  The smallest radius that encloses the smallest axis-aligned bounding-box
of the object.

##### Skin thickness

A random walker is assumed to have hit the surface of the object if the distance
between the surface and the walker is less than the skin thickness.  Default
value:  1e-6 times the launch radius


##### Units for length

Specifies the units for the length for all objects.
The length can take the following units:

* m (meters)
* cm (centimeters)
* nm (nanometers)
* A (Angstroms)
* L (generic or unspecified length units)

##### Temperature

Specifies the temperature, which is used for computing the diffusion coefficient.

##### Mass

Specify the mass of the object, which is used for computing the intrinsic
viscosity in conventional units and the sedimentation coefficient. The mass can
take the following units:
* Da (Daltons)
* kDa (kiloDaltons)
* g (grams)
* kg (kilograms)

##### Solvent viscosity

Specify the solvent viscosity, which is used for computing the diffusion
coefficient, the friction coefficient, and the sedimentation coefficient. It can
take the following units:
* p (poise)
* cp (centipoise)



##### Buoyancy factor
Specify the buoyancy factor, which is used for computing the sedimentation
coefficient.
